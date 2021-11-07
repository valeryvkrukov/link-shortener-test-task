import { createApp } from 'vue';
import MainForm from './components/MainForm';

const app = createApp({});

app.component('main-form', MainForm);

app.mount('#app');

require('./bootstrap');