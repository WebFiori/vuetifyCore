<?php

use Themes\VuetifyCore\VueHeadSectionV2;

require_once '../../vendor/autoload.php';

$head = new VueHeadSectionV2();

echo '<html>'.$head.'<body><div id="app">
<v-card>
<v-card-title>Hi, Vuetify V'.VUETIFY_VERSION.'</v-card-title>
</v-card>
</div>
<script>

app = new Vue({
    el:"#app",
    data: {
        drawer:null,
    },
    vuetify: new Vuetify({

    })
});
</script>
</body></html>';
