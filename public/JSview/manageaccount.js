let resetBtn = document.getElementById("resetbtn");
let inputs = document.querySelectorAll('input[type="text"]');

  resetBtn.addEventListener("click",e=>{
    resetfields();
  })
  
  



function resetfields(){
   inputs.forEach(element=>{
    element.value="";
   })
}