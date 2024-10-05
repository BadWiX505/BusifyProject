
function displaySignUpErrors(errArray){
     let parent = document.querySelector('.alert .flex');
     parent.innerHTML="";
    errArray.forEach(element => {
        parent.innerHTML+= `<div class="flex-shrink-0">
        <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 alert-svg">
          <path clip-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" fill-rule="evenodd"></path>
        </svg>
      </div>
      <div class="alert-prompt-wrap">
        <p class="text-sm text-yellow-700">
        ${element}
        </p>
    </div>
     `
    });
}



function emailVerificationTimer(){
  let timer = document.querySelector(".timer_wrapper span:first-child");
  let resend = document.querySelector(".timer_wrapper span:last-child");
  Timer();
  function Timer(){
   totalTime = 120;
   let sec,min;
  let TimerID=setInterval(()=>{
    totalTime--;
      min=Math.floor(totalTime/60);
      sec=Math.floor(totalTime%60);
      if(totalTime==0){
        clearInterval(TimerID); 
        location.reload(true);
        resend.style.display="inline-block";
      }
       updateTimer(sec,min);
    },1000)
  }

  function updateTimer(sec,min){
    let m,s;
    m= min<=9?'0'+min:min;
    s=sec<=9?'0'+sec:sec;
    timer.innerHTML = `${m}:${s}`;
  }
}



  function hideShowpass(){
  document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('pass');
    const eyeIcon = document.querySelector('.inputForm svg:last-child');

    eyeIcon.addEventListener('click', function () {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    });
  });
}




// Ajax query to check informations when signUp 
   function checkSignUpInfos(token){
    console.log("hhhh")
    document.querySelector(".svgloader").style.display="block";
    var recaptchaResponse = token;
    var fname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;
    var checked = document.getElementById('agree').checked;

    var formData = new FormData();
    formData.append('g-recaptcha-response', recaptchaResponse);
    formData.append('firstname', fname);
    formData.append('lastname', lastname);
    formData.append('email', email);
    formData.append('password', pass);
    formData.append('agree', checked);
      
    let destination = 'index.php?action=checkSignUp';

    ajax(destination,formData,'JSON').
    then(data => {
      if(data.length == 0) {
        document.getElementById("form").submit();
      } else {
        document.querySelector(".svgloader").style.display="none";
        displaySignUpErrors(data);
      }
    })
  }




// check the validity of given code 

function checkemailCode(){
  let givencode = document.querySelector('.input_field').value;
  let myform = document.querySelector('.form');
  var formData = new FormData();
   formData.append('code',givencode);
   let destination = 'index.php?action=checkCC';
   
   ajax(destination,formData,'JSON').
   then(data => {
    if(data['status']!='nice'){
      document.querySelector('.input_field').style.border="1px solid red";
      document.querySelector('.input_field').classList.add("shakeIt");
    }
    else{
      myform.submit();
    }
  })

}


//Ajax querie to check Login infos
function checkLogInInfos(token){
  document.querySelector(".svgloader").style.display="block";
  var recaptchaResponse = token;
  var email = document.getElementById('email').value;
  var pass = document.getElementById('pass').value;
  var checked = document.getElementById('rem').checked;

  var formData = new FormData();
  formData.append('g-recaptcha-response', recaptchaResponse);
  formData.append('email', email);
  formData.append('password', pass);
  formData.append('remember',checked)

  let destination = 'index.php?action=checkLogin';
   ajax(destination,formData,'JSON').
   then(data => {
    console.log(data);
    if(data.length == 0) {
      window.location.href="index.php?action=Home";
    } else {
      document.querySelector(".svgloader").style.display="none";
      displaySignUpErrors(data);
    }
  })
}



// check gmail existance using ajax request 

function checkgmail(token){
  document.querySelector(".svgloader").style.display="block";
  var recaptchaResponse = token;
  var email = document.getElementById('email').value;
  var formData = new FormData();
  formData.append('email', email);
  formData.append('g-recaptcha-response', recaptchaResponse);
  let destination = 'index.php?action=cGmail';


  ajax(destination,formData,'JSON')
  .then(finalRes => {
      if (finalRes.length === 0) {
        document.querySelector('.form').submit();
      } else {
        document.querySelector(".svgloader").style.display = "none";
        document.querySelector(".field-container").classList.add("anim");
        document.querySelector(".excl").style.display = "block";
      }
    })
.catch(error => {
    console.error(error);
});

}


// check new password confirmation code using 
function checkGCC(){
  var code = document.getElementById('code').value;
  var formData = new FormData();
  formData.append('code', code);
  let destination = 'index.php?action=Gverification';

  ajax(destination,formData,'TEXT')
  .then(finalRes => {
      if (finalRes === 'good') {
        document.querySelector('.form').submit();
      } else {
        document.querySelector(".field-container").classList.add("anim");
        document.querySelector(".excl").style.display = "block";
      }
    })
.catch(error => {
    console.error(error);
});

}



function checknewPass(){
  var pass= document.getElementById('pass').value;
  var formData = new FormData();
  formData.append('password', pass);
  let destination = 'index.php?action=passvalidity';

  ajax(destination,formData,'TEXT')
  .then(finalRes => {
      if (finalRes === 'good') {
        document.querySelector('.form').submit();
      } else {
        document.querySelector(".field-container").classList.add("anim");
        document.querySelector(".excl").style.display = "block";
      }
    })
.catch(error => {
    console.error(error);
});

}



function ajax(destination, data, datatype) {
  return fetch(destination, {
      method: 'POST',
      body: data,
  })
  .then(response => {
      if (datatype === 'JSON')
          return response.json(); 
      else
          return response.text();
  })
  .then(dataRes => {
      return dataRes; 
  })
  .catch(error => {
      window.location.href = "index.php?action=err";
      console.error('Error:', error);
  });
}