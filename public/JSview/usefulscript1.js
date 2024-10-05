
// observe statistics in home page
document.addEventListener('DOMContentLoaded', function () {
  const elementToAnimate = document.querySelectorAll('.statisticsSection > div');
  
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';     
      }
    });
  });
  elementToAnimate.forEach(element => {
  observer.observe(element);
  });
  startSecondObserver();
  startSecondObserver2();  
}
)

// observe New recipes  in home page


function startSecondObserver() {
  const element2 = document.querySelector(".newrecipescontainer");
  const observer2 = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          element2.style.opacity = '1'; // Apply animation when in view
        }, 500);
      }
      else{
        element2.style.opacity = '0'; 
      }
    });
  });
  observer2.observe(element2);
}


// observe chefs in home page
function startSecondObserver2() {
  const element2 = document.querySelectorAll(".chefbox");
  animationdelay=0;
  const observer2 = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        console.log("hhh");
          entry.target.classList.add("animation")// Apply animation when in view
          entry.target.style.animationdelay=animationdelay+"s"
          animationdelay+=0.2;
      }
    });
  });
element2.forEach(element=>{
  observer2.observe(element);
})
}

// scroll in newrecipce in home page
let rightbtn = document.querySelector("#rightbtn");
let leftbtn = document.querySelector("#leftbtn");
let recipescontainer = document.querySelector(".newsection_imagecontent");
let currentIndex = 0;

rightbtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % recipescontainer.children.length;
    updateTransform();
});

leftbtn.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + recipescontainer.children.length) % recipescontainer.children.length;
    updateTransform();
});

function updateTransform() {
    recipescontainer.scrollLeft = currentIndex * (250 + 40); // Width + Margin
}


// loading animation

