<template>
	<div>
		<div class="search-bar">
			<input type="text" placeholder="Search through your contacts by name" v-model="searchTerm">
		</div>
		<div v-if="contacts.length > 0">
			<contact-card v-for="contact in contacts" :contact="contact" :key="contact.addr_id"></contact-card>
			<span v-if="contacts.length > 10" class="centered">Who needs pagination?</span>
		</div>
		<div class="box centered" v-else>
			Unable to find any contacts!
		</div>
	</div>
</template>

<script>
	import { mapGetters } from 'vuex'
	import ContactCard from './ContactCard.vue'
	export default {
		data() {
			return {
				searchTerm: ''
			}
		},
		//get the list of contacts from the state
		computed: {
			contacts() {
				if(!this.searchTerm) return this.$store.getters.contacts
					else return this.$store.getters.contacts.filter(contact => contact.full_name.toLowerCase().includes(this.searchTerm.toLowerCase()))
				}
		},
		components: {
			ContactCard
		}
	}
</script>

<style lang="scss" scoped>
	.centered {
		text-align: center;
		padding: 10px;
	}

	.search-bar {
		width: 100%;
		background: #FFF;
		border-radius: 2px;
		box-shadow: 0 0 1px 1px rgba(0,0,0,0.15);
		margin-top: 20px;
		padding: 7px 0 7px 0;
		input {
			width: 100%;
			text-align: center;
			border-radius: 2px;
			outline: none;
			border: none;
		}
	}
</style>