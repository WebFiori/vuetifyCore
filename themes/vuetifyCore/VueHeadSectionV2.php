<?php
namespace themes\vuetifyCore;

use webfiori\framework\ui\WebPage;
/**
 * This class represents head section the theme.
 * 
 * It uses vue 2 and vuetify 2.
 */
class VueHeadSectionV2 extends CommonHead {
    /**
     * Creates new instance of the class.
     */
    public function __construct(WebPage $page) {
        parent::__construct($page);
        $vueVersion = '2.7.16';
        $vuetifyVersion = '2.7.2';
        
        if (WF_VERBOSE) {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.js", [
                'integrity' => "sha256-NrENO0kgWSpOwmwGTEKemj37RokjX9/JHhc2toHHZ4Y=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
        } else {
            $this->addJs("https://unpkg.com/vue@$vueVersion/dist/vue.min.js", [
                'integrity' => "sha256-PB1LDFSejenUqbr7EqtwtqGsdH0HKTuYxbJbZjKZmv0=",
                'crossorigin' => "anonymous",
                'id' => 'vue-script',
                'version' => $vueVersion
            ]);
        }

        $this->addCSS("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.css", [
            'integrity' => "sha256-Y2/mvM8cPptVwHOaNUPMi+I636ATzQd9zc4vvqWIv/I=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-css',
            'version' => $vuetifyVersion
        ]);
        $this->addJs("https://cdnjs.cloudflare.com/ajax/libs/vuetify/$vuetifyVersion/vuetify.min.js", [
            'integrity' => "sha256-CStrrGPWeCKqJCtxBeZ/UebZkA72s/hhfcQrHSYp0fs=",
            'crossorigin' => "anonymous",
            'id' => 'vuetify-script',
            'version' => $vuetifyVersion
        ]);
    }
}
