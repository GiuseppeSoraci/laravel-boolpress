// FRONT OFFICE

window.Vue = require('vue');
// window.axios = require('axios');

// INIT VUE MAIN INSTANCE
import App from './App.vue';
import router from './routes';

const root = new Vue({
    el: '#root',
    router,
    render: n => n(App)
});
