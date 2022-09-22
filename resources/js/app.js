require('./bootstrap');
require('video.js')

window.Vue = require('vue').default;
window.swal = require('sweetalert2');

import VueRouter from 'vue-router';
import routes from './routes';
import moment from 'moment';
import Vue from 'vue';
import VueEsc from 'vue-esc';
import videojs from 'video.js';
window.videojs = videojs;
// import 'video.js/dist/video-js.css';
// import 'video.js/dist/video-js.min.css';
// import 'video.js/dist/video.min.js';


// import Swal from 'sweetalert2';

Vue.filter('timeago', (arg)=>{
    return moment(arg).format('lll');
});

Vue.filter('timewhen', (arg)=>{
    return moment(arg).format("MMM Do YY");
});

Vue.use(VueRouter);
Vue.use(VueEsc);

const app = new Vue({
    el: '#app',

    router: new VueRouter(routes)

});
