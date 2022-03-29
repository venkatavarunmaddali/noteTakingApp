<template>
	<div>
		<div v-for = "(item,index) in items" :key="index">
			
			<div class = "item">
				<span class='itemText'>{{item.note}}</span>
				<button @click="removenote(item)" class="appbutton">delete</button>
				<button @click="editnote(item)" class="appbutton">edit</button>
			</div>
		</div>
	</div>
	<div id="noteEditModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
	    <input type="text" v-model = "current_note"/>
	    <button type="button"  class="appbutton" @click = "updateItem()">update</button>
	    <button type="button"  class="appbutton" @click = "closeModal()">close</button>
	  </div>

	</div>
</template>

<script>
import listItem from "./listItem"
export default {
	props : ['items'],
	components : {
		listItem
	},
	data: function (){
		return {
				current_note:"",
				current_id:0,
		}
	},
	methods: {
		removenote(list){
			axios.delete('/notes/'+list.id)
			.then(response => {
				if(response.status == 200) {
					this.$emit('reloadlist')
				}
			})
			.catch(error => {
				console.log(error);
			})
		},
		editnote(list){
			this.current_note = list.note;
			this.current_id = list.id;
			var modal = document.getElementById("noteEditModal");
			modal.style.display = "block";
		},
		closeModal(){
			var modal = document.getElementById("noteEditModal");
			modal.style.display="none";
		},
		updateItem(){
				if(this.current_note == ''){
					return;
				}
				axios.patch('/notes/'+this.current_id, {
					note: this.current_note
				}).then ( response => {
					if(response.status == 200){
						this.current_note = "";
						this.$emit('reloadlist');
	 				}
				})
				.catch(error => {
					console.log(error);
				})
			var modal = document.getElementById("noteEditModal");
			modal.style.display="none";
		}
	},
}
</script>

<style scoped>

.item {
	background : #e6e6e6;
	padding : 5px;
	margin-top : 5px;
}

input{
	backgrpund : #f7f7f7f7;
	border : 1px;
	outline : none;
	padding : 5px;
	margin-right: 10px;
	width:100%;
}

.item {
	display : flex;
	justify-content: center;
	align-items: center;
}

.itemText {
	width : 100%;
	margin-left:20px;
}


.appbutton{
	background : #e6e6e6;
	outline : none;
	padding: 5px;
	margin: 5px;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #e6e6e6; /* Fallback color */
  background-color: #e6e6e6; /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  align : center;
  background-color: #e6e6e6;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>