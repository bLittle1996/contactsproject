//Vuex provides STATE MANAGEMENT

import Vue from 'vue'
import VueX from 'vuex'
import { ContactsModule } from './modules/ContactsModule'
Vue.use(VueX)
export const store = new VueX.Store({
	modules: {
		contacts: ContactsModule
	}
})