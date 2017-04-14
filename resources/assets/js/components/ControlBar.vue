<template>
	<div class="box">
		<div class="wrapper">
			<div class="button">
				<router-link  class="button-link" to="/"><div><i class="fa fa-address-book fa-2x" aria-hidden="true"></i></div><div>View All</div></router-link>
			</div>
			<div class="button">
				<router-link class="button-link" to="/contacts/new"><div><i class="fa fa-id-card fa-2x" aria-hidden="true"></i></div><div>New Contact</div></router-link>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: "ControlBar",
	}
</script>
<style lang="scss" scoped>
	.wrapper {
		display: flex;
		width: 100%;
		text-align: center;
		.button {
			width: 50%;
			align-text: center;
			.button-link {
				padding: 10px;
				color: #3097D1;
				text-decoration: none;
				&:hover {
					color: darken(#3097D1, 10%)
				}
			}
			&:hover {
				background: darken(#FFF, 5%);
			}
		}
	}
</style>