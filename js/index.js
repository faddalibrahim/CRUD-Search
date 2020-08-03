//showing the update form overlay
document.querySelector(".todos").addEventListener("click", function(e){
  if(e.target.className === 'update-btn'){
     document.querySelector("#update-form-container").style.display = "flex";
     document.querySelector("#update-form input[type=text]").value = e.target.dataset.data;
     document.querySelector("#update-form .id-field").value = e.target.dataset.id;
     alert("yeh hats it");

  }

})

//closing the update form overlay
document.querySelector("#close").addEventListener("click",function(){
  this.closest("#update-form-container").style.display = "none";
})


document.getElementById("select-multiple-button").addEventListener("click",function(){
	document.querySelectorAll(".todo input[type=checkbox]").forEach(checkbox => checkbox.toggleAttribute("hidden")); //show checkboxes
	document.getElementById("delete-selected-button").toggleAttribute("hidden"); //show delete selected button
})


document.getElementById("delete-selected-button").addEventListener("click",function(){
	let checkedIds = Array.from(document.querySelectorAll(".todo input[type=checkbox]"))
			  		.filter(checkbox => checkbox.checked)
			  		.map(checkbox => Number(checkbox.dataset.id));

	let stringedIds = JSON.stringify(checkedIds);


	document.getElementById("delete-selected-prompt").style.display = "flex"; //show prompt overlay

	document.getElementById("yes-delete-selected").href = "delete-all.php?ids=" + stringedIds; // add ids array to href of "yes" button
})
