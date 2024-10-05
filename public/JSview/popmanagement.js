let acountbtn= document.querySelector(".Signinbtn");
let options = document.querySelector(".acount-options")
console.log("hhhh");
acountbtn.addEventListener("click",e=>{
   if(options.classList.contains("popacount")){
    options.classList.remove("popacount");
   }
   else{
    options.classList.add("popacount");
   }
})