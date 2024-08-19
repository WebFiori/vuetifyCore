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
        $vueVersion = '3.4.38';
        $vuetifyVersion = '3.7.0';
        
        if (WF_VERBOSE) {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.js", [
                'integrity' => "sha256-1Qx6XHZstesVjfLvZMC0ajCH251OgRQHo0/dsQKq+iA=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
            
        } else {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.prod.js", [
                'integrity' => "sha256-tQ7u/jXUFja7lskrQPHfC0+3kU4Hs8YlsewV6XSHZ7k=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
        }
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.css", [
            'integrity' => "sha256-Zeo1HaJcT3vsIiti7p+5fcOBZoKVRryOt2urVcZCd+Y=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-css',
            'version' => $vuetifyVersion
        ]);
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.css", [
            'integrity' => "sha256-20Vz8LbqHOXecrKd56gzolekLtDYSN9P6v63Q3I3QOQ=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-css',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.js", [
            'integrity' => "sha256-XPHMrdnnWx5e9Hwyrv/mCplodeoPAqCBoSFudcXB6tk=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-script',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.js", [
            'integrity' => "sha256-gQusreKYnkVllreEEjHU6uKA4JupLr1ER+DJ4jzcfjU=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-script',
            'version' => $vuetifyVersion
        ]);
    }
}
