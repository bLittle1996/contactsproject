<template>
	<div class="box">
		<div class="wrapper">
			<div class="contact-card">
				<div class="profile-picture">
					<img src="/images/nick.png" alt="Based God Nicholas Cage">
				</div>
				<div class="information">
					<div class="name">
						<div class="first-name">
						<i class="fa fa-user" aria-hidden="true"></i>
							<input type="text" id="addr_first_name" v-model="newContact.addr_first_name" placeholder="First Name">
						</div>
						<div class="last-name">
							<input type="text" id="addr_last_name" v-model="newContact.addr_last_name" placeholder="Last Name">
						</div>
					</div>
					<div class="location">
						<div class="city">
						<i class="fa fa-building" aria-hidden="true"></i>
							<input type="text" id="addr_city" v-model="newContact.addr_city" placeholder="City">
						</div>
						<div class="region">
							<input type="text" id="addr_region" v-model="newContact.addr_region" placeholder="Region">
						</div>
					</div>
					<div class="phone-numbers">
						<div class="phone-number">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<input type="text" id="addr_phone_1" v-model="newContact.addr_phone_1" placeholder="Phone Number #1"></div>
						<div class="phone-number"><input type="text" id="addr_phone_2" v-model="newContact.addr_phone_2" placeholder="Phone Number #2"></div>
					</div>
					<div class="emails">
						<div class="email"><i class="fa fa-envelope" aria-hidden="true"></i><input type="text" id="addr_email_1" v-model="newContact.addr_email_1" placeholder="Email #1"></div>
						<div class="email"><input type="text" id="addr_email_2" v-model="newContact.addr_email_2" placeholder="Email #2"></div>
					</div>
				</div>
				<button type="submit" @click="storeNewContact">Create</button>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'ContactCreate',
		//using v-model we can have reactive data updates!
		data() {
			return {
				newContact: {
					addr_first_name: '',
					addr_last_name: '',
					addr_city: '',
					addr_region: '',
					addr_phone_1: '',
					addr_phone_2: '',
					addr_email_1: '',
					addr_email_2: ''
				}
			}
		},
		methods: {
			storeNewContact() {
				this.$store.dispatch("STORE_CONTACT", this.newContact).then(response => {
					this.$router.push('/')
				}, error => {
					let badFields = JSON.parse(error.responseText)
					this.clearErrors()
					Object.keys(badFields).forEach(field => {
						field = field.replace(' ', '_')
						this.setError(field)
					})
				})
			},
			//Quick and dirty error highlighting, don't judge ;)
			clearErrors() {
				Object.keys(this.newContact).forEach(field => {
					field = field.replace(' ', '_')
					document.getElementById(field).className = document.getElementById(field).className.replace('error', '')
				})
			},
			setError(fieldName) {
				document.getElementById(fieldName).className += ' error'
			}
		}
	}
</script>

<style lang="scss" scoped>
	.fa {
		margin: 10px;
		color: #3097D1;
	}
	.error {
		border: solid 1px red;
	}
	.contact-card {
		position: relative;
		display: flex;
		padding: 30px;
		.profile-picture {
			flex-grow: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			img {
				border-radius: 50%;
				width: 150px;
				height: 150px;
			}
		}
		.information {
			display: flex;
			flex-direction: column;
			flex-grow: 1;
			div {
				display: flex;
				justify-content: space-around;
			}
		}
	}

	input {
		padding: 5px;
		font-family: 'Raleway', sans-serif;
		border-radius: 2px;
		outline: none;
		border: none;
		border-bottom: solid 1px grey;
	}

	button {
		position: absolute;
		bottom: 10px;
		right: 10px;
		padding: 6px 10px 6px 10px;
		font-family: 'Raleway', sans-serif;
		color: white;
		background: #3097D1;
		border: none;
		border-radius: 2px;
		&:hover {
			cursor: pointer;
			background: darken(#3097D1, 5%);
		}
	}
</style>