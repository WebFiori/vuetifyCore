<?php
namespace themes\vuetifyCore;

use webfiori\framework\App;
use webfiori\framework\ui\WebPage;
use webfiori\json\CaseConverter;
use webfiori\json\Json;
use webfiori\ui\HTMLNode;

/**
 * The base page which is used to created pages which is based on Vuetify.
 * 
 * This class serves two objectives. First is to help in setting the script
 * which is used to initialize Vue and Vuetify. The script is appended to the
 * body of the page with &lt;script&gt; element with 'id='vue-init'.
 * 
 * Secondly, it provides developer with the global 'data' JavaScript object at
 * which the developer can use to pass values from backend to the rendered
 * frontend web page. The object is created at the end of the &lt;head&gt;
 * tag inside a &lt;script&gt; element before the page is rendered.
 *
 * @author Ibrahim
 */
class VuetifyWebPage extends WebPage {
    /**
     * 
     * @var Json
     */
    private $jsonData;
    private $jsFolderPath;
    /**
     * Creates new instance of the class.
     */
    public function __construct() {
        parent::__construct();

        $this->addBeforeRender(function (VuetifyWebPage $p)
        {
            $p->addToJson([
                'dir' => $p->getTranslation()->getWritingDir()
            ]);
            $p->addBeforeRender(function (VuetifyWebPage $p2) {
                $jsCode = new HTMLNode('script', [
                    'id' => 'server-json-data',
                    'nonce' => str_replace('=','',base64_encode(hash('sha256', microtime().'-'. random_bytes(10))))
                ]);
                $jsCode->text('data = '.$p2->getJson(), false);
                $p2->getDocument()->getHeadNode()->addChild($jsCode);
            },100);
        }, 100);
        $this->jsonData = new Json();
        $this->setVueScript($this->getPrimaryVueFilePath());
    }
    /**
     * Adds a set of attributes to the global 'data' JavaScript object.
     * 
     * This method will add attributes to the global 'data' JsvaScript object.
     * 
     * @param array $arrOfAttrs An associative array. The indices of the array 
     * are attributes names and the value of each index is the value that will 
     * be passed.
     */
    public function addToJson(array $arrOfAttrs) {
        foreach ($arrOfAttrs as $attrKey => $attrVal) {
            $this->getJson()->add($attrKey, $attrVal);
        }
    }
    /**
     * Adds a mixins JS file to the head tag.
     * 
     * @param string $fileName The name of the mixins file such as 'add-user-mixins.js'.
     * 
     * @param string|null $path An optional path that points to the location
     * of the file in public folder. If not specified, the method will use same
     * path as the primary vue script.
     */
    public function addMixins(string $fileName, ?string $path = null) {
        if ($path === null) {
            $path = $this->jsFolderPath;
        }
        if ($path === null) {
            return;
        }
        $this->addJS($path.$fileName);
    }
    /**
     * Returns an object of type Json that contains all JSON attributes which 
     * will be added to the global 'data' JavaScript object.
     * 
     * Initially, the object will contain all common attributes for all pages.
     * 
     * @return Json
     */
    public function getJson() {
        return $this->jsonData;
    }
    /**
     * Sets the JavaScript file which will be used to initialize vue.
     * 
     * @param string $jsFilePath A string that represents the path of the 
     * file such as 'assets/js/init-vue.js'.
     */
    public function setVueScript($jsFilePath) {
        
        $this->addBeforeRender(function (WebPage $page, string $jsPath)
        {
            $base = $page->getBase();
            
            if (!strpos($jsPath, $base) === false) {
                $jsPath = trim($base,"/").'/'.trim($jsPath, "/");
            }
            $page->removeChild('vue-init');
            $page->getDocument()->addChild('script', [
                'type' => 'text/javascript',
                'src' => $jsPath.'?jv='.App::getConfig()->getAppVersion(),
                'id' => 'vue-init'
            ]);
        }, 0, [$jsFilePath]);
    }
    /**
     * Constructs and returns a default path for the primary JavaScript file
     * that has code which is used to initialize vue application.
     * 
     * The method will construct the path as follows, first, it will take
     * the name of the class, including namestace and convert it to kebab
     * case and convert all characters to lower case. 
     * 
     * Note that the method assumes that the class is created inside the folder
     * '[APP_DIR]/pages' of the application. Also, it assumes that the JS file
     * will be inside the folder '[public-folder]/assets/js'.
     * 
     * 
     * @return string A string such as 'assets/js/my-page.js'.
     */
    public function getPrimaryVueFilePath() {
        $pagesFolder = APP_DIR.'\\'.'pages';
        $clazz = static::class;
        $expl = explode('\\', $clazz);
        $className = $expl[count($expl) - 1];
        $fileName = CaseConverter::toKebabCase($className, 'lower').'.js';
        $trim1 = substr($clazz, strlen($pagesFolder));
        $this->jsFolderPath = 'assets/js'.str_replace('\\', '/', substr($trim1, 0, -1*strlen($className)));
        
        return $this->jsFolderPath.$fileName;
    }
    /**
     * Converts an array of labels to JSON objects which could be used as items 
     * for selects or auto-complete components of Vuetify.
     * 
     * @param string|array $labelOrArrOfLabels A label location which exist in the language class.
     * Also, this can be an array that holds the labels.
     * 
     * @param array $extraAttrs An associative array that holds extra 
     * attributes to set for an item. The indices of the array should
     * represent the key and the value is a sub-associative array of 
     * values.
     * 
     * @return array The method will return an array that holds objects of type 
     * Json. Each object will have at least two attributes, 'value' 
     * and 'text'. The object may have extra attributes based on what values
     * passed in the array <b>$extraAttrs</b>.
     */
    public function toVItems($labelOrArrOfLabels, array $extraAttrs = []) {
        if (gettype($labelOrArrOfLabels) == 'array') {
            $data = $labelOrArrOfLabels;
        } else {
            $data = $this->get($labelOrArrOfLabels);
        }
        $retVal = [];

        if (gettype($data) == 'array') {
            foreach ($data as $key => $lbl) {
                $jsonItem = new Json([
                    'text' => $lbl,
                    'value' => $key,
                    'title' => $lbl,
                    'key' => $key
                ]);
                
                if (isset($extraAttrs[$key]) && gettype($extraAttrs[$key]) == 'array') {
                    foreach ($extraAttrs[$key] as $itemKey => $val) {
                        $jsonItem->add($itemKey, $val);
                    }
                }
                $retVal[] = $jsonItem;
            }
        }

        return $retVal;
    }
}
