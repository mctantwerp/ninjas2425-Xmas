import { createApp } from 'vue';

const app = createApp({});

import searchRebus from './components/rebus/searchRebus.vue';

//event listener import
import mitt from 'mitt';
//create eventbus
const eventBus = mitt();
//make globally accessible
app.config.globalProperties.$bus = eventBus;

import firstPopup from './components/popups/firstPopup.vue';
import finalPopup from './components/popups/finalPopup.vue';
import windowPopup from './components/popups/windowPopup.vue';
import submitPopup from './components/popups/submitPopup.vue';
import submitPage from './components/pages/submitPage.vue';
import negativeWindowPopup from './components/popups/negativeWindowPopup.vue';
import snowFlakes from './components/decorations/snowFlakes.vue';
import searchGame from './components/search/searchGame.vue';
import treeGame from './components/tree/treeGame.vue';
import hintPopup from './components/popups/hintPopup.vue';


import Navbar from './components/Navbar.vue';

import rebusPage from './components/pages/rebusPage.vue';
import searchPage from './components/pages/searchPage.vue';
import treePage from './components/pages/treePage.vue';

app.component('search-rebus', searchRebus);
app.component('final-popup', finalPopup);
app.component('first-popup', firstPopup);
app.component('rebus-page', rebusPage);
app.component('navbar', Navbar);
app.component('window-popup', windowPopup);
app.component('submit-popup', submitPopup);
app.component('submit-page', submitPage);
app.component('negative-window-popup', negativeWindowPopup);
app.component('snow-flakes', snowFlakes);
app.component('search-page', searchPage);
app.component('search-game', searchGame);
app.component('tree-game', treeGame);
app.component('tree-page', treePage);
app.component('hint-popup', hintPopup);


app.mount('#app');

