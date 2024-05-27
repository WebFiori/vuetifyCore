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
        $vueVersion = '3.3.4';
        $vuetifyVersion = '3.6.7';
        
        if (WF_VERBOSE) {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.js", [
                'integrity' => "sha256-IXVQMd/RK00yn/mSOrq8ncqOYUMrEiMzjNY90HIyai0=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
            
        } else {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.global.prod.js", [
                'integrity' => "sha256-YoSXy2nfex0xI2R5ytaMm7PyZQYK/VUGoMAEs5TfpH4=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
        }
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.css", [
            'integrity' => "sha256-Fq0iR1su3PRCTr3Np88PsQs1tZErJNI9SpDxlGOWJME=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-css',
            'version' => $vuetifyVersion
        ]);
        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.css", [
            'integrity' => "sha256-O/1EB8o+9BUdML1KisBXfHdAe8Eghnz0Nc+USUptxTk=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-css',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.js", [
            'integrity' => "sha256-QuS+7+m1qkvSC3eZok8148QK0txPXziOxCcVVUKd4WI=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-script',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify-labs.min.js", [
            'integrity' => "sha256-CA68JjfTzGAw7dAZiMvZcKflZXoetJo6MH0Bw0jq3vY=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-labs-script',
            'version' => $vuetifyVersion
        ]);
    }
}
