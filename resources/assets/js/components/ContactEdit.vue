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
							<input type="text" class="errorable" id="addr_first_name" v-model="contactToEdit.addr_first_name" placeholder="First Name">
						</div>
						<div class="last-name">
							<input type="text" class="errorable" id="addr_last_name" v-model="contactToEdit.addr_last_name" placeholder="Last Name">
						</div>
					</div>
					<div class="location">
						<div class="city">
							<i class="fa fa-building" aria-hidden="true"></i>
							<input type="text" class="errorable" id="addr_city" v-model="contactToEdit.addr_city" placeholder="City">
						</div>
						<div class="region">
							<input type="text" class="errorable" id="addr_region" v-model="contactToEdit.addr_region" placeholder="Region">
						</div>
					</div>
					<div class="phone-numbers">
						<div class="phone-number">
							<i class="fa fa-phone" aria-hidden="true"></i>
							<input type="text" class="errorable" id="addr_phone_1" v-model="contactToEdit.addr_phone_1" placeholder="Phone Number #1"></div>
							<div class="phone-number"><input type="text" class="errorable" id="addr_phone_2" v-model="contactToEdit.addr_phone_2" placeholder="Phone Number #2"></div>
						</div>
						<div class="emails">
							<div class="email">
								<i class="fa fa-envelope" aria-hidden="true"></i>
								<input type="email" class="errorable" id="addr_email_1" v-model="contactToEdit.addr_email_1" placeholder="Email #1">
							</div>
							<div class="email">
								<input type="email" class="errorable" id="addr_email_2" v-model="contactToEdit.addr_email_2" placeholder="Email #2">
							</div>
						</div>
					</div>
					<button type="submit" @click="putContact">Update</button>
				</div>
			</div>
		</div>
	</template>

	<script>
		import { mapGetters } from 'vuex'
		export default {
			name: 'ContactEdit',
		//using v-model we can have reactive data updates!
		computed: Object.assign({}, mapGetters(['contactToEdit'])),
		methods: {
			putContact() {
				this.$store.dispatch("UPDATE_CONTACT", this.contactToEdit).then(response => {
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
				document.querySelectorAll('.errorable').forEach(field => field.className = "errorable")
			},
			setError(fieldName) {
				document.getElementById(fieldName).className += ' error'
			}
		},
		mounted() {
			if(!this.contactToEdit) this.$router.push('/')
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