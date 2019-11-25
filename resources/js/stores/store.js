import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
	state:{ 
		profesional:"",
	},

	mutations:{
        agregarNombre(state,nombre){
        	console.log('El nombre:', nombre.data.name)
            this.state.profesional = nombre.data.name
        },
	},

	actions:{
        getUser({commit}){
            axios.get('/auth/user')
                .then(function (response) {
                    const data = response.data;
                    commit("agregarNombre", data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
	}
});