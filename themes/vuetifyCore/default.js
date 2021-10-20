/* global data */

app = new Vue({
    el:"#app",
    data: {
        rtl:data.dir === 'rtl',
        drawer:null,
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
    vuetify: new Vuetify()
});