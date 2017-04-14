<template>
    <div class="container">
   	<control-bar></control-bar>
   	<router-view></router-view>
    </div>
</template>

<script>
	import { mapGetters } from 'vuex'
	import ControlBar from './ControlBar.vue'
	export default {
		name: 'Dashboard',
		data() {
			return {

			}
		},
		//lets us use other components inside of this one! they can be accessed by their-name-with-dashes in the template
		components: {
			ControlBar
		},
		//this function fires when the component is mounted to the DOM
		mounted() {
			//make a dispatch to our store, does the method named in the call :)
			this.$store.dispatch("FETCH_CONTACTS")
		}

	}
</script>

<style lang="scss" scoped>
</style>