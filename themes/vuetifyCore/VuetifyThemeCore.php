<?php
namespace themes\vuetifyCore;

use webfiori\framework\Theme;
use webfiori\ui\HTMLNode;

abstract class VuetifyThemeCore extends Theme {
    /**
     * Creates new instance of the class.
     * 
     * @param string $themeName An optional theme name.
     */
    public function __construct($themeName = '') {
        parent::__construct($themeName);
        $this->setVersion('1.2');
        $this->setAuthor('Ibrahim BinAlshikh');
        $this->setDescription('This theme creates basic page structure for '
                .'building themes which can be based on Vuetify. Vuetify is a '
                .'powerfull material design UI kit which can help in building '
                .'amazing user interface.');
        $this->setAuthorUrl('https://ibrahim-binalshikh.me');
        $this->setLicenseName('MIT');
        $this->setLicenseUrl('https://opensource.org/licenses/MIT');

        $this->setAfterLoaded(function (Theme $theme)
        {
            $page = $theme->getPage();
            $vueEl = new HTMLNode('div', [
                'id' => 'app'
            ]);
            $appEl = $vueEl->addChild('v-app');
            $appEl->addChild($page->removeChild('page-header'));
            $appEl->addChild($page->removeChild('page-body'));
            $appEl->addChild($page->removeChild('page-footer'));
            $page->getDocument()->getBody()->addChild($vueEl);
            $page->getChildByID('main-content-area')->setNodeName('v-main');
            $page->getDocument()->addChild('script', [
                'id' => 'vue-script',
                'src' => 'https://cdn.jsdelivr.net/gh/webfiori/vuetifyCore@1.2/themes/vuetifyCore/default.js'
            ]);
        });
    }
}
