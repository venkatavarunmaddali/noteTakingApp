<template>
	<div class="addItem">
		<input type="text"  v-model="note"/>
		<button type="button" :class="[note ? 'active':'inactive','add']" @click = "addItem()">Add</button>
	</div>
</template>

<script>
export default {
	data: function (){
		return {
				note:""
		}
	},
	methods: {
		addItem(){
			if(this.note == ''){
				return;
			}

			axios.post('/notes', {
				note: this.note
			}).then ( response => {
				if(response.status == 200){
					this.note = "";
					this.$emit('reloadlist');
 				}
			})
			.catch(error => {
				console.log(error);
			})
		}
	}
}
</script>

<style>
.addItem {
	display:flex;
	justify-content:center;
	align-items: center;
}
input{
	backgrpund : #f7f7f7f7;
	border : 0px;
	outline : none;
	padding : 5px;
	margin-right: 10px;
	width:100%;
}

.add{
	background : #e6e6e6;
	outline : none;
	padding: 5px;
	margin: 5px;
}

</style>