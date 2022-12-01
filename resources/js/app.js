require('./bootstrap');

import { createApp } from 'vue';
import NBack from './components/NBack';

const app = createApp({});
app.component('nback', NBack);
app.mount('#app');
