import { createApp } from 'vue';
import VueCookies from 'vue-cookies';
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './App.vue';
import router from './router.js';
import store from './store/Store.js';

const app = createApp(App); // Criar uma instância do aplicativo Vue
app.use(router); // Usar o roteador Vue Router
app.use(VueCookies); // Usar o VueCookies
app.use(VueAxios, axios)  // Usar o VueAxios    
app.use(store); // Usar a store Vuex
app.mount('#app'); // Montar o aplicativo na div com o id "app"
