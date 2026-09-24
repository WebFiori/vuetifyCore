<?php
namespace Themes\VuetifyCore;

use WebFiori\Framework\Ui\WebPage;


/**
 * A head tag that holds CDN files for vue 3 and vuetify 3.
 * 
 */
class VueHeadSectionV3 extends CommonHead {
    public function __construct(?WebPage $page = null) {
        parent::__construct($page);
        
        define('VUE_VERSION', '3.5.43');
        define('VUETIFY_VERSION', '3.13.4');
        
        $vueVersion = VUE_VERSION;
        $vuetifyVersion = VUETIFY_VERSION;

        if (defined('WF_VERBOSE') && WF_VERBOSE) {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.js", [
                'integrity' => "sha256-sZHPgJqoNFKXGAT53y2MZ95l3jTKpA8Pz4KMUIxwmeI=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
            
        } else {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.prod.js", [
                'integrity' => "sha256-tyOUBS7vHu2hdS2zdYzhvm+IAWkD8i5SQcxzLqMHR44=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
        }
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.css", [
            'integrity' => "sha256-LsQnvvA4gowcaTwpLGPeQO1QXygJj8G75cg/1bgE8/k=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-css',
            'version' => $vuetifyVersion
        ]);
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.css", [
            'integrity' => "sha256-+cnQ6KMuAvf/Me6hvBgvDqgS/DIshOZbHoc9GXyB6qU=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-css',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.js", [
            'integrity' => "sha256-Jv+kke0whkrfEiCVUdrD9nn2KrSagEMROqzTvvtA2Ng=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-script',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.js", [
            'integrity' => "sha256-NA5dpG5meleNbTGjsJoq8wuXUrFlUpiG4QHAQ5cW8T4=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-script',
            'version' => $vuetifyVersion
        ]);
    }
}
