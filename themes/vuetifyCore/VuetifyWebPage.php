<?php
namespace themes\vuetifyCore;

use webfiori\framework\ui\WebPage;
use webfiori\framework\WebFioriApp;
use webfiori\json\Json;
use webfiori\ui\HTMLNode;

/**
 * The base page which is used to created pages which is based on Vuetify.
 * 
 * This class serves two objectives. First is to help in setting the script
 * which is used to initialize Vue and Vuetify. The script is appended to the
 * body of the page with &lt;script&gt; element with 'id='vue-script'.
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
                $jsCode = new HTMLNode('script');
                $jsCode->text('data = '.$p2->getJson(), false);
                $p2->getDocument()->getHeadNode()->addChild($jsCode);
            });
        }, [], 100);
        $this->jsonData = new Json();
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
            $page->removeChild('vue-script');
            $page->getDocument()->addChild('script', [
                'type' => 'text/javascript',
                'src' => $jsPath.'?jv='.WebFioriApp::getAppConfig()->getVersion(),
                'id' => 'vue-script'
            ]);
        }, [$jsFilePath], 0);
    }
    /**
     * Converts an array of labels to JSON objects which could be used as items 
     * for selects or auto-complete components of Vuetify.
     * 
     * @param string|array $label A label location which exist in the language class.
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
    public function toVItems(string $label, array $extraAttrs = []) {
        if (gettype($label) == 'array') {
            $data = $label;
        } else {
            $data = $this->get($label);
        }
        $retVal = [];

        if (gettype($data) == 'array') {
            foreach ($data as $key => $lbl) {
                $jsonItem = new Json([
                    'text' => $lbl,
                    'value' => $key
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
