app = new Vue({
    el:"#app",
    data: {
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