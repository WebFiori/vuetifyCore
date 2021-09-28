<?php
namespace themes\vuetifyCore;

use webfiori\framework\ui\WebPage;
use webfiori\json\Json;
use webfiori\ui\HTMLNode;

/**
 * The base page which is used to created pages which is based on Vuetify.
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
        
        $this->addBeforeRender(function (VuetifyWebPage $p) {
            $jsCode = new HTMLNode('script');
            $jsCode->text('data = '.$p->getJson());
            $p->getDocument()->getHeadNode()->addChild($jsCode);
        });
        $this->jsonData = new Json();
    }
    /**
     * Converts an array of labels to JSON objects which could be used as items 
     * for selects or auto-complete components of Vuetify.
     * 
     * @param string $label A label location which exist in the language class.
     * 
     * @return array The method will return an array that holds objects of type 
     * Json. Each object will have at least two attributes, 'value' 
     * and 'text'.
     */
    public function toVItems($label) {
        $data = $this->get($label);
        $retVal = [];
        
        if (gettype($data) == 'array') {
            foreach ($data as $key => $lbl) {
                $retVal[] = new Json([
                    'text' => $lbl,
                    'value' => $key
                ]);
            }
        }
        
        return $retVal;
    }
    /**
     * Adds a set of attributes to the json data.
     * 
     * This method will add attributes to the global 'data' JsvaScript object.
     * 
     * @param array $arrOfAttrs An associative array. The indices of the array 
     * are attributes names and the value of each index is the value that will 
     * be passed.
     */
    public function addToJson($arrOfAttrs) {
        foreach ($arrOfAttrs as $attrKey => $attrVal) {
            $this->getJson()->add($attrKey, $attrVal);
        }
    }
    /**
     * Returns an object of type Json that contains all JSON attributes.
     * 
     * Initially, the object will contain all common attributes for all pages.
     * 
     * @return Json
     * 
     */
    public function getJson() {
        return $this->jsonData;
    }
    /**
     * Sets the JavaScript file which will be used to initialize vue.
     * 
     * @param string $jsFilePath A string that represents the path of the 
     * file such as 'assets/js/init-vue.js'.
     * 
     */
    public function setVueScript($jsFilePath) {
        $this->addBeforeRender(function (WebPage $page, $jsPath) {
            $page->removeChild('vue-script');
            $page->getDocument()->addChild('script', [
                'type' => 'text/javascript',
                'src' => $jsPath.'?jv='.WebFioriApp::getAppConfig()->getVersion(),
                'id' => 'vue-script'
            ]);
        }, [$jsFilePath]);
    }
}
