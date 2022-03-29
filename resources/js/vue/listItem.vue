<template>
	<div class = "item">
	<span class='itemText'>{{item.id}}{{item.note}}</span>
	<button @click="removenote()" class="delete">delete</button>
	<button @click="editnote(item)" class="delete">edit</button>
	<div :id="'myModal_'+item.id">
		<div id="current_id" class="modal">

		  <!-- Modal content -->
		  <div class="modal-content">
		    <input type="text" v-model = "this.current_note"/>
		    <button type="button"  @click = "updateItem(item.id)">update</button>
		    <button type="button"  @click = "closeModal()">close</button>
		  </div>

		</div>
	</div>
	</div>
</template>

<script>
export default {
	props: ['item'],
	data: function (){
		return {
				current_note:"",
				current_id:0,
		}
	},
	methods: {
		removenote(){
			axios.delete('/notes/'+this.item.id)
			.then(response => {
				if(response.status == 200) {
					this.$emit('itemchanged')
				}
			})
			.catch(error => {
				console.log(error);
			})
		},
		editnote(list){
			this.current_note = list.note;
			this.current_id = list.id;
 			console.log("after assigning" +this.current_note);
 			console.log(this.current_id);
 			let name = "'myModal_'+list.id";
			var modal = document.getElementById(name);
			modal.style.display = "block";
		},
		closeModal(){
			var modal = document.getElementById("myModal");
			modal.style.display="none";
		},
		updateItem(id){
				if(this.note == ''){
					return;
				}
				console.log(id);
				axios.patch('/notes/'+this.item.id, {
					note: this.current_note
				}).then ( response => {
					if(response.status == 201){
						this.note = "";
						this.$emit('reloadlist');
	 				}
				})
				.catch(error => {
					console.log(error);
				})
			var modal = document.getElementById("myModal");
			modal.style.display="none";
		}
	},

}
</script>

<style scoped>

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

.delete{
	background : #e6e6e6;
	outline : none;
	padding: 5px;
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
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
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