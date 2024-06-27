import VueCookies from 'vue-cookies';
import axios from 'axios';

// Configurações padrão do Axios
const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api', // URL base da sua API
  timeout: 5000, // Tempo limite para as requisições (em milissegundos)
  headers: {
    'Authorization': 'Bearer ' + VueCookies.get('token'), // Token de autenticação
  },
});

// Interceptor para ajustar o Content-Type conforme os dados que estão sendo enviados
api.interceptors.request.use(config => {
  // Verifica se os dados são uma instância de FormData
  if (config.data instanceof FormData) {
    config.headers['Content-Type'] = 'multipart/form-data';
  } else {
    // Remove o cabeçalho Content-Type, permitindo que o Axios defina o padrão
    delete config.headers['Content-Type'];
  }
  return config;
}, error => {
  return Promise.reject(error);
});

// Interceptor para lidar com respostas
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
