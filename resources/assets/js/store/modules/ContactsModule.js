import Vue from 'vue'
import _ from 'lodash'

export const ContactsModule =  {
	state: {
		contacts: [],
		contactToEdit: {}
	},
	getters: {
		contacts(state) { return state.contacts },
		contactToEdit(state) { return state.contactToEdit }
	},
	//asyncronous
	actions: {
		//create a function that can be DISPATCHED from components. Pass it this states mutations, so we can change the state.
		//actions trigger mutations, which mutate (hehe) the state. 
		FETCH_CONTACTS({ commit }) {
			return new Promise((resolve, reject) => {
				$.get('/api/contacts').then(response => {
					commit("ASSIGN_CONTACTS", response)
					resolve(response)
				}, error => {
					console.error("Unable to fetch contacts!", error)
					reject(error)
				})
			})
		},
		FETCH_CONTACT({ commit }, contactId) {
			return new Promise((resolve, reject) => {
				if(typeof contanctId !== "number") console.error("FETCH_CONTACT: Expected contact ID to be number.")
					else $.get(`api/contacts/${contactId}`).then(response => {
						commit("FETCH_CONTACT")
						resolve(response)
					}, error => {
						console.error("Unable to fetch contact!", error)
						reject(error)
					})
				})
		},
		STORE_CONTACT({ dispatch }, contact) {
			return new Promise((resolve, reject) => {
				if(!contact instanceof Object) console.error(`STORE_CONTACT: Expected Object. Received ${typeof contact}`)
					else $.post('/api/contacts', contact)
						.then(response => { 
							dispatch("FETCH_CONTACTS")
							resolve(response)
						}, 
						error => { 
							console.error("Unable to create contact.")
							reject(error)
						})
				})
		},
		UPDATE_CONTACT({ dispatch }, contact) {
			return new Promise((resolve, reject) => {
				if(!(contact instanceof Object)) console.error(`UPDATE_CONTACT: Expected Object. Received ${typeof contact}`)
					else if(!contact.addr_id) console.error('UPDATE_CONTACT: No ID for contact provided.')
						else $.ajax({ url: `/api/contacts/${contact.addr_id}`, data: contact, method: 'PUT' })
							.then(response => {
								dispatch("FETCH_CONTACTS")
								resolve(response)
							}, 
							error => {
								console.error("Unable to update contact!", error)
								reject(error)
							})
					})
		},
		DESTROY_CONTACT({ dispatch }, contactId) {
			return new Promise((resolve, reject) => {
				if(!contactId) console.error('DESTpROY_CONTACT: No ID for contact provided.')
					else $.ajax({ url: `/api/contacts/${contactId}`, method: 'DELETE' })
						.then(response => {
							dispatch("FETCH_CONTACTS")
							resolve(response)
						}, 
						error => {
							console.error("Unable to create contact.")
							reject(error)
						})
				})
		}
	},
	//not async
	mutations: {
		//set the states contacts property to a provided array
		ASSIGN_CONTACTS(state, contacts) {
			if(contacts instanceof Array) state.contacts = contacts
				else console.error(`ASSIGN_CONTACTS: Expected Array. Received ${typeof contacts}`)
			},
		ASSIGN_CONTACT(state, contact) {
			if(!contact instanceof Object) console.error(`ASSIGN_CONTACT: Expected Object. Received ${typeof contact}`)
				else {
					const indexToUpdate = _.findIndex(state.contacts, contactObj => contactObj.id == contact.id)
					if(indexToUpdate > -1) state.contacts[indexToUpdate] = contact
				}
		},
		ASSIGN_CONTACT_TO_EDIT(state, contact) {
			if(!contact instanceof Object) console.error(`ASSIGN_CONTACT_TO_EDIT: Expected Object. Received ${typeof contact}`)
				else {
					state.contactToEdit = contact
				}
		}
	}
}