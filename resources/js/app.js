import { createApp } from 'vue';

const app = createApp({});

import searchRebus from './components/rebus/searchRebus.vue';
import firstPopup from './components/firstPopup.vue';
import Navbar from './components/Navbar.vue';

app.component('search-rebus', searchRebus);
app.component('first-popup', firstPopup);
app.component('navbar', Navbar);


app.mount('#app');

