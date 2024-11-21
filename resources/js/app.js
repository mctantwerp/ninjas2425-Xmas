import { createApp } from 'vue';

const app = createApp({});

import searchRebus from './components/rebus/searchRebus.vue';

//event listener import
import mitt from 'mitt';
//create eventbus
const eventBus = mitt();
//make globally accessible
app.config.globalProperties.$bus = eventBus;

import firstPopup from './components/firstPopup.vue';
import finalPopup from './components/finalPopup.vue';
import screenModalPopup from './components/screenModalPopup.vue';


import Navbar from './components/Navbar.vue';

import rebusPage from './components/rebusPage.vue';

app.component('search-rebus', searchRebus);
app.component('final-popup', finalPopup);
app.component('first-popup', firstPopup);
app.component('rebus-page', rebusPage);
app.component('screen-modal-popup', screenModalPopup);
app.component('navbar', Navbar);


app.mount('#app');

