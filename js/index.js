document.querySelector(".todos").addEventListener("click", function(e){
  if(e.target.textContent === 'update'){
     document.querySelector("#update-form-container").style.display = "flex";
     document.querySelector("#update-form input[type=text]").value = e.target.dataset.data;
     document.querySelector("#update-form input[type=hidden]").value = e.target.value;

  }

})


document.querySelector("#close").addEventListener("click",function(){
  this.closest("#update-form-container").style.display = "none";
})
