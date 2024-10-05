
import { displayMSG } from './popupconfig.js';
// Get the current date in the format "YYYY-MM-DD"
function getCurrentDate(daysToAdd = 0) {
   const today = new Date();
   today.setDate(today.getDate() + daysToAdd);
   const year = today.getFullYear();
   const month = String(today.getMonth() + 1).padStart(2, '0');
   const day = String(today.getDate()).padStart(2, '0');
   return `${year}-${month}-${day}`;
}



var personnumberList = document.querySelector(".personsgrid");
var timelist = document.querySelector(".personsgrid.timegrid");
var inputPerso = document.getElementById('personsbar')

var inputTime = document.querySelector('#time');
var PersonsOptions = document.querySelectorAll('#persongrid > div')

var TimeOptions = document.querySelectorAll('#timesgrid > div');



TimeOptions.forEach(element => {
   $(document).on("click", "#timesgrid > div", (event) =>{
      inputTime.value = $(event.target).text();
      hideShow(timelist);
   })
});


PersonsOptions.forEach(element => {
   element.onclick = () => {
      inputPerso.value = element.textContent;
      hideShow(personnumberList);
   }
})


inputTime.addEventListener("click", e => {
   hideShow(timelist);
})

inputPerso.addEventListener("click", e => {
   hideShow(personnumberList);
})



function hideShow(ele) {
   if (ele.classList.contains("show")) {
      ele.classList.remove("show");
   }
   else if (checkIsDateSelected()) {
      ele.classList.add("show");
   }
}


function checkIsDateSelected() {
   if ($('[type="date"]').val() == '') {
      displayMSG('Please Select date First')
      return false;
   }
   else {
      return true;
   }
}

$('[type="date"]').change(() => {
   checkTimeVsDate($('[type="date"]').val());
   inputTime.value='';
})


$('form').on("submit",function(event) {
   event.preventDefault(); 
   VRI($('[type="date"]').val(),$('[type="tel"]').val(),$('#personsbar').val(),$('#time').val());
})



function VRI(dt,tel,np,T) {
   $.ajax({
      url: "index.php?action=VRI", 
      type: "GET",
      dataType: "text",
      data: {
         date: dt,
         phone : tel,
         persons : np,
         Time : T,
      },
      success: function (response) {
         if(response=='log'){
            displayMSG('Please log in first');
            var Int=setTimeout(()=>{
               window.location.href="index.php?action=login";
               clearTimeout(Int);
            },2000);
         }
         else if(response=='good'){
            $('form')[0].submit();
         }
         else{
            displayMSG(response);
         }
      },
      error: function (xhr, status, error) {
         console.error(xhr.responseText);
         window.location.href = "index.php?action=err";
      }
   });
}



function checkTimeVsDate(valDate) {
   $.ajax({
      url: "index.php?action=checkDateVsTime", // URL of the PHP script to load food items
      type: "GET",
      dataType: "json",
      data: {
         date: valDate,
      },
      success: function (response) {
         displayTimes(response);
      },
      error: function (xhr, status, error) {
         console.error(xhr.responseText);
         window.location.href = "index.php?action=err";
      }
   });
}


function displayTimes(Times = []) {
   if (Times.length != 0) {

       
      var html = '';
      for (var index in Times) {
         html += '<div>' + formatTime(Times[index]) + '</div>'
      }

      $('#timesgrid').html(html);
   }
}



function formatTime(time) {
      var hours = parseInt(time.substring(0, 2)); // Extract the hours part
      var minutes = time.substring(3, 5); // Extract the minutes part
  
      var period = 'AM'; // Default to AM
  
      // If the hour is greater than or equal to 12, set the period to PM and subtract 12
      if (hours >= 12) {
          period = 'PM';
      }
     
  
      // Format hours and minutes as hh:mm
      var formattedTime = hours.toString().padStart(2, '0') + ':' + minutes;
  
      return formattedTime + ' ' + period;
  }
  


// Set the min attribute for the date input
document.querySelector('[type="date"]').min = getCurrentDate(0);
document.querySelector('[type="date"]').max = getCurrentDate(30);


