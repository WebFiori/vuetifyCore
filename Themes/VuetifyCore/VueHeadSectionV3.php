<?php
namespace Themes\VuetifyCore;

use WebFiori\Framework\Ui\WebPage;


/**
 * A head tag that holds CDN files for vue 3 and vuetify 3.
 * 
 */
class VueHeadSectionV3 extends CommonHead {
    public function __construct(WebPage $page) {
        parent::__construct($page);
        
        define('VUE_VERSION', '3.5.22');
        define('VUETIFY_VERSION', '3.10.3');
        
        $vueVersion = VUE_VERSION;
        $vuetifyVersion = VUETIFY_VERSION;

        if (defined('WF_VERBOSE') && WF_VERBOSE) {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.js", [
                'integrity' => "sha256-Ka+7P07D8H/NDYgiK7BYrLnsYlPYzPlBL45gbUpYEhY=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
            
        } else {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.prod.js", [
                'integrity' => "sha256-2unBeOhuCSQOWHIc20aoGslq4dxqhw0bG7n/ruPG0/4=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
        }
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css", [
            'integrity' => "sha256-A/48q6BeZbFOQDUTnu6JsSvofNC880KsOIZ3Duw6mWI=",
            'crossorigin' => "anonymous"
        ]);
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.css", [
            'integrity' => "sha256-hX27sGJbWKQMwtOB6Wi24yy0c/sF1ZD3PQbnpAMV+/U=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-css',
            'version' => $vuetifyVersion
        ]);
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.css", [
            'integrity' => "sha256-NPHYAkvbGN9rN5PLyexRnLP1eXJE4JuRb3Jeyrd7EP4==",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-css',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.js", [
            'integrity' => "sha256-giyx/CJouYmk5r3yZ/vlWayMWVrCdPB0DG9dYYtMElk=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-script',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.js", [
            'integrity' => "sha256-mRW9D4I/lWPNbUPLfI+D5ME4s3lmYU9wIFhMtUIo3w0=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-script',
            'version' => $vuetifyVersion
        ]);
    }
}
