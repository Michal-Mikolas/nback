require('./bootstrap');

import { createApp } from 'vue';
import NBack from './components/NBack';
import PersonalInfoForm from './components/PersonalInfoForm';

const app = createApp({});
app.component('nback', NBack);
app.mount('#app');
