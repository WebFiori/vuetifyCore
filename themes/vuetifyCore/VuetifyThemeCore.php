<?php
namespace themes\vuetifyCore;

use webfiori\framework\Theme;
use webfiori\ui\HTMLNode;

abstract class VuetifyThemeCore extends Theme {
    /**
     * Creates new instance of the class.
     */
    public function __construct(){
        parent::__construct();
        //TODO: Set the properties of your theme.
        $this->setName('Vuetify Base Theme');
        $this->setVersion('1.0');
        $this->setAuthor('Ibrahim BinAlshikh');
        $this->setDescription('This theme creates basic page structure for '
                . 'building themes which can be based on Vuetify. Vuetify is a '
                . 'powerfull material design UI kit which can help in building '
                . 'amazing user interface.');
        $this->setAuthorUrl('https://ibrahim-binalshikh.me');
        $this->setLicenseName('MIT');
        $this->setLicenseUrl('https://opensource.org/licenses/MIT');
        //$this->setCssDirName('css');
        //$this->setJsDirName('js');
        //$this->setImagesDirName('images');
        $this->setAfterLoaded(function (Theme $theme) {
            $page = $theme->getPage();
            $appEl = new HTMLNode('div', [
                'id' => 'app'
            ]);
            $appEl->addChild($page->removeChild('page-header'));
            $appEl->addChild($page->removeChild('page-body'));
            $appEl->addChild($page->removeChild('page-footer'));
            $page->getDocument()->getBody()->addChild($appEl);
            $page->getChildByID('main-content-area')->setNodeName('v-main');
            $page->getDocument()->addChild('script', [
                'id' => 'vue-script',
                'src' => ''
            ]);
        });
    }
}
