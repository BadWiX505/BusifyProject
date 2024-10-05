let toTop = document.querySelector(".toTop");

toTop.onclick=()=>{
    window.scrollTo(
        {
            left : 0,
            top : 0,
            behavior : "smooth"
        }
    )
}


window.onscroll=()=>{
    if(window.scrollY>600){
        toTop.style.display="block"
    }
    else{
        toTop.style.display="none"
    }
}