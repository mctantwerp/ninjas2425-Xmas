import { createApp } from 'vue';

const app = createApp({});

import searchRebus from './components/rebus/searchRebus.vue';



import firstPopup from './components/firstPopup.vue';
import screenModalPopup from './components/screenModalPopup.vue';


import Navbar from './components/Navbar.vue';

import rebusPage from './components/rebusPage.vue';

app.component('search-rebus', searchRebus);
app.component('first-popup', firstPopup);
app.component('rebus-page', rebusPage);
app.component('screen-modal-popup', screenModalPopup);
app.component('navbar', Navbar);


app.mount('#app');

