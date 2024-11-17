import { createApp } from 'vue';

const app = createApp({});

import test from './components/hangman/test.vue';

app.component('test', test);

app.mount('#app'); // Ensure your Blade template has an element with this ID

