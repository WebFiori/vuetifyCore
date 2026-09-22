/* global data, Vue, Vuetify */

/*
 * Default Vue 2 + Vuetify 2 application initializer for VuetifyCore themes.
 *
 * Loaded when the page uses VueHeadSectionV2 (Vue 2.7.x / Vuetify 2.x).
 * Vue 2 mounts via `new Vue({...})` and Vuetify 2 accepts the top-level
 * `rtl` option directly.
 */
app = new Vue({
    el: "#app",
    data: {
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
    },
    vuetify: new Vuetify({
        rtl: data.dir === 'rtl',
    })
});
