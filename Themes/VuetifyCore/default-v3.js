/* global data, Vue, Vuetify */

/*
 * Default Vue 3 + Vuetify 3 application initializer for VuetifyCore themes.
 *
 * Loaded when the page uses VueHeadSectionV3 (Vue 3.x / Vuetify 3.x).
 * The server injects a global `data` object (see VuetifyWebPage) which is
 * used here to configure locale/RTL and seed the root component state.
 */
const { createApp } = Vue;
const { createVuetify } = Vuetify;

const vuetify = createVuetify({
    locale: {
        // Vuetify 3 handles RTL through the locale configuration rather than
        // the removed top-level `rtl` option used in Vuetify 2.
        rtl: {
            en: data.dir === 'rtl'
        }
    }
});

const vueApp = createApp({
    data() {
        return {
            drawer: null,
            cards: ['Today', 'Yesterday'],
            inbox_links: [
                ['mdi-inbox-arrow-down', 'Inbox'],
                ['mdi-send', 'Send'],
                ['mdi-delete', 'Trash'],
                ['mdi-alert-octagon', 'Spam'],
            ],
            constrained_links: [
                'Dashboard',
                'Messages',
                'Profile',
                'Updates',
            ],
            three_column_links: [
                'Dashboard',
                'Messages',
                'Profile',
                'Updates',
            ],
        };
    },
    methods: {},
    computed: {},
    mounted: function () {}
});

var app = vueApp.use(vuetify).mount('#app');
