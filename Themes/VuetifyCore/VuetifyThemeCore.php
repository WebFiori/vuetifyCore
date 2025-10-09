<?php
namespace themes\vuetifyCore;

use webfiori\framework\Theme;
use webfiori\ui\HTMLNode;
/**
 * A base theme for creating Vuetify based themes.
 * 
 * This theme is used to re-structure a web page based on common Vue and Vuetify
 * page structure. It simply create a top element which acts as the root 'application'
 * element. Inside the element placed other page sections.
 */
abstract class VuetifyThemeCore extends Theme {
    /**
     * 
     * @var string The ID of the element that represents the 'application' element
     */
    private $appElId;
    /**
     * Creates new instance of the class.
     * 
     * @param string $themeName An optional theme name.
     */
    public function __construct($themeName = '') {
        parent::__construct($themeName);
        $this->setVersion('1.2.5');
        $this->setAuthor('Ibrahim BinAlshikh');
        $this->setDescription('This theme creates basic page structure for '
                .'building themes which can be based on Vuetify. Vuetify is a '
                .'powerfull material design UI kit which can help in building '
                .'amazing user interface.');
        $this->setAuthorUrl('https://ibrahim-binalshikh.me');
        $this->setLicenseName('MIT');
        $this->setLicenseUrl('https://opensource.org/licenses/MIT');
        $this->setAppID('app');
        
        $this->setAfterLoaded(function (VuetifyThemeCore $theme)
        {
            $page = $theme->getPage();
            $vueEl = new HTMLNode('div', [
                'id' => $theme->getAppID()
            ]);
            $appEl = $vueEl->addChild('v-app');
            $appEl->addChild($page->removeChild('page-header'));
            $appEl->addChild($page->removeChild('page-body'));
            $appEl->addChild($page->removeChild('page-footer'));
            $page->getDocument()->getBody()->addChild($vueEl);
            $page->getChildByID('main-content-area')->setNodeName('v-main');
            $page->getDocument()->addChild('script', [
                'id' => 'vue-init',
                'src' => 'https://cdn.jsdelivr.net/gh/webfiori/vuetifyCore@1.x.x/themes/vuetifyCore/default.js'
            ]);
        });
    }
    /**
     * Returns the ID of the 'div' that will be used as root Vue application.
     *  
     * @return string Default return value is 'app'.
     */
    public function getAppID() {
        return $this->appElId;
    }
    /**
     * Sets the ID of the 'div' that will be used as root Vue application.
     * 
     * @param string $id A non empty string.
     */
    public function setAppID($id) {
        $trimmed = trim($id);
        
        if (strlen($trimmed) > 0) {
            $this->appElId = $trimmed;
        }
    }
}
