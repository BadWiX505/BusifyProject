document.addEventListener("DOMContentLoaded", function() {
    console.log(" i am running")
    document.querySelector('.loadercontainer').style.display = 'flex';
    document.querySelector('.loadercontainer').style.opacity = '1';
  
    // Hide the loader after a delay (e.g., 2000 milliseconds or 2 seconds)
    setTimeout(function() {
      document.querySelector('.loadercontainer').style.opacity = '0';
        document.querySelector('.loadercontainer').style.display = 'none';
    }, 1000);
  });
  