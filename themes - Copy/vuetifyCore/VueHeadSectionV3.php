<?php
namespace themes\vuetifyCore;

use webfiori\framework\ui\WebPage;


/**
 * A head tag that holds CDN files for vue 3 and vuetify 3.
 * 
 */
class VueHeadSectionV3 extends CommonHead {
    public function __construct(WebPage $page) {
        parent::__construct($page);
        
        define('VUE_VERSION', '3.5.14');
        define('VUETIFY_VERSION', '3.7.8');
        
        $vueVersion = VUE_VERSION;
        $vuetifyVersion = VUETIFY_VERSION;
        if (WF_VERBOSE) {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.js", [
                'integrity' => "sha256-pMWQ5r9rnIyHnjdyvp6GlqmxIr/veom1EbAa22k8fu0=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
            
        } else {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.prod.js", [
                'integrity' => "sha256-ewTfzPdWQgxTZNeP25A9hU8AQCfVrFVIzJQA5el11nw=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
        }
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.css", [
            'integrity' => "sha256-Dlnp/rmEf5MhIrKZ5rNvXH1C+gW5S0eczEPPdHtIVDg=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-css',
            'version' => $vuetifyVersion
        ]);
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.css", [
            'integrity' => "sha256-SfpdqbfoTXHiaZrXGNV3D3IKogXsj99VJ1TYowZ53nw=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-css',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.js", [
            'integrity' => "sha256-f9d1J5BICD5jgnzKaWeHZL4IXPkjh04tKPQRo8T2awY=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-script',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.js", [
            'integrity' => "sha256-kDjMygj+Kz7W1UO7mhNwVvKeZy99WuiDyz/CueRp5eI=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-script',
            'version' => $vuetifyVersion
        ]);
    }
}
