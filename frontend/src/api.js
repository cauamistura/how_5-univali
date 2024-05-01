import VueCookies from 'vue-cookies';
import axios from 'axios';

// Configurações padrão do Axios
const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api', // URL base da sua API
  timeout: 5000, // Tempo limite para as requisições (em milissegundos)
  headers: {
    'Content-Type': 'application/json', // Tipo de conteúdo das requisições
    'Authorization': 'Bearer ' + VueCookies.get('token'), // Token de autenticação
  },
});

api.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    if (error.response && error.response.status === 401) {
      // Se o status da resposta for 401 (não autenticado), remove o token dos cookies
      VueCookies.remove('token');
      // Redireciona o usuário para a página de login
      window.location.href = '/';
    }            
    return Promise.reject(error);
  }
);

export default api;
