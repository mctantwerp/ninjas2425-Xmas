import { createApp } from 'vue';

import snowFlakes from './components/decorations/snowFlakes.vue';

const app = createApp({});

app.component('snow-flakes', snowFlakes);

app.mount('.error-page-wrapper');
