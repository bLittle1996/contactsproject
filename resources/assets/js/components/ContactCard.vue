<template>
	<div class="box">
		<div class="wrapper">
			<div class="contact-card">
				<div class="profile-picture">
					<img src="/images/nick.png" alt="Based God Nicholas Cage">
				</div>
				<div class="information">
					<div class="name">
						<i class="fa fa-user" aria-hidden="true"></i>&nbsp{{ contact.full_name }}
					</div>
					<div class="location" v-if="contact.addr_city || contact.addr_region">
						<i class="fa fa-building" aria-hidden="true"></i>&nbsp;{{ contact.addr_city }}    {{ contact.addr_region }}
					</div>
					<div class="phone" v-if="contact.addr_phone_1 || contact.addr_phone_2">
						<i class="fa fa-phone" aria-hidden="true"></i>&nbsp;{{ contact.addr_phone_1 }}    {{ contact.addr_phone_2 }}
					</div>
					<div class="email" v-if="contact.addr_email_1 || contact.addr_email_2">
						<i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;{{ contact.addr_email_1 }}    {{ contact.addr_email_2 }}
					</div>
				</div>
				<div class="card-controls">
					<div class="edit" @click="editContact">
					<i class="fa fa-pencil fa-2x" aria-hidden="true"></i>&nbsp;Edit
					</div>
					<div class="delete" @click="deleteContact">
						<i class="fa fa-trash fa-2x" aria-hidden="true"></i>&nbsp;Delete
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['contact'],
		methods: {
			editContact() {
				this.$store.commit("ASSIGN_CONTACT_TO_EDIT", this.contact)
				this.$router.push('/contacts/edit')
			},
			deleteContact() {
				this.$store.dispatch("DESTROY_CONTACT", this.contact.addr_id)
			}
		}
	}
</script>

<style lang="scss" scoped>
	.card-controls{
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: space-around;
		.edit, .delete {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			color: #3097D1;
			&:hover {
				cursor: pointer;
				i {
					color: darken(#3097D1, 5%);
				}
			}
		}
	}
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