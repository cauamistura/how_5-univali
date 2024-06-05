import { createStore } from 'vuex';

export default createStore({
  state: {
    mensagemAlerta: '',
    tipoAlerta: 'is-success',
    exibirAlerta: false
  },
  mutations: {
    MOSTRAR_ALERTA(state, { mensagem, tipo }) {
      state.mensagemAlerta = mensagem;
      state.tipoAlerta = tipo;
      state.exibirAlerta = true;
      setTimeout(() => {
        state.exibirAlerta = false;
      }, 1500);
    }
  },
  actions: {
    mostrarAlerta({ commit }, payload) {
      commit('MOSTRAR_ALERTA', payload);
    }
  }
});
