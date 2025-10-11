<?php

use Themes\VuetifyCore\VueHeadSectionV3;

require_once '../../vendor/autoload.php';

$head = new VueHeadSectionV3();

echo '<html>'.$head.'<body><div id="app">
<v-card>
<v-card-title>Hi, Vuetify V'.VUETIFY_VERSION.'</v-card-title>
</v-card>
</div>
<script>
const { createApp } = Vue;
const { createVuetify } = Vuetify;


const vuetify = createVuetify({
  
});
const vue = createApp({
    mixins: [],
    data() {
       return {
           
       };
    },
    methods:{
        
    },
    computed:{
        
    },
    mounted:function() {

    }
});
var app = vue.use(vuetify).mount(\'#app\');
</script>
</body></html>';
