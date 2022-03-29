<template>
	<div class = "notesContainer">
		<div class="heading">
			<h2 id="title"> Notes App </h2>
			<add-item-form v-on:reloadlist="getList()"></add-item-form>
		</div>
		<list-view :items="items" v-on:reloadlist="getList()"></list-view>
	</div>
</template>

<script>

import addItemForm from "./addItemForm"
import listView from  "./listview"

export default {
	components: {
		addItemForm,
		listView
	},
	data : function (){
		return {
			items: []
		}
	},
	methods: {
		getList(){
			axios.get('/notes')
			.then(response => {
				this.items = response.data.data
			})
			.catch(error => {
				console.log(error);
			})
		}
	},
	created(){
		this.getList();
	}
}

</script>

<style scoped>

.notesContainer {
	width:350px;
	margin:auto;
}

.heading {
	background : #e6e6e6;
	padding : 10px;
}

#title {
	text-align : center
}

</style>