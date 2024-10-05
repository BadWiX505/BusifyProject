<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
body{
    display: flex;
    justify-content: center;
}
.StripeElement {
  background-color: white;
  padding: 8px 14px;
  border-radius: 4px;
  border: 1px solid #E4E4E4;
}

.StripeElement--focus {
  border-color: #00CCFF;
}

.StripeElement--invalid {
  border-color: #FF0033;
}

.StripeElement--webkit-autofill {
  background-color: #F9F9F9 !important;
}
label {
  font-family: 'Lato', sans-serif;
  font-weight: 600;
  font-size: 14px;
  display: block;
  margin-bottom: 10px;
  color: #646464;
}

form {
  padding: 30px;
  height: 120px;
}

.form-row {
  width: 553px;
  padding-top: 13px;
}

button {
  font-family: 'Lato', sans-serif;
  border: none;
  outline: none;
  color: #FFF;
  background: #fd9900;
  cursor: pointer;
  white-space: nowrap;
  display: inline-block;
  height: 40px;
  line-height: 40px;
  padding: 0 14px;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: 0.025em;
  text-decoration: none;
  margin-top: 10px;
}

#card-errors {
  font-family: 'Lato', sans-serif;
  font-weight: 600;
  font-size: 12px;
  display: block;
  height: 20px;
  padding: 4px 0;
  color: #FF2255;
}

.field--focus {
  border-color: #00CCFF;
}

.field--invalid {
  border-color: #FF2255;
}

.field--webkit-autofill {
  background-color: #F9F9F9 !important;
}

.field--placeholder {
  color: #D4D4D4;
}

.field {
  background: white;
  box-sizing: border-box;
  font-size: 14px;
  font-weight: 400;
  border: 1px solid #E4E4E4;
  border-radius: 4px;
  color: #242424;
  outline: none;
  height: 36px;
  line-height: 36px;
  cursor: text;
  width: 553px;
  padding: 8px 14px;
}

.svgloader {
 width: 3.25em;
 display: none;
  transform-origin: center;
 animation: rotate4 2s linear infinite;
 position: fixed;
 border-radius: 8px;
 top: 50%;
 left: 50%;
 transform: translate(-50%,-50%);
}

circle {
fill: none;
stroke: rgb(250 204 21);
stroke-width: 5;
stroke-dasharray: 1, 200;
stroke-dashoffset: 0;
stroke-linecap: round;
animation: dash4 1.5s ease-in-out infinite;
}

@keyframes rotate4 {
100% {
transform: rotate(360deg)  translate(-50%,-50%);

}
}
@keyframes dash4 {
0% {
stroke-dasharray: 1, 200;
stroke-dashoffset: 0;
}

50% {
stroke-dasharray: 90, 200;
stroke-dashoffset: -35px;
}

100% {
stroke-dashoffset: -125px;
}
}

</style>

<body>
<div class="wrapper">
<form action="paymentProcess" method="post" id="payment-form">
  <div class="form-row">
    <label for="card-element">
      Credit or debit card number
    </label>
    <div id="card-element">
      <!-- a Stripe Element will be inserted here. -->
    </div>
    <!-- Used to display form errors -->
    <div id="card-errors" role="alert"></div>
  </div>
 
    
  <button onclick="startLoading()" >PAY NOW</button>
</form>

<svg viewBox="25 25 50 50" class="svgloader">
  <circle r="20" cy="50" cx="50"></circle>
   </svg>
  
</div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    function disablePrev() { 
        window.history.forward(); 
    }
    
    window.onload = disablePrev;
    
    window.onpageshow = function(evt) { 
        if (evt.persisted) 
            disablePrev(); 
    };
});

 function startLoading(){
  document.querySelector(".svgloader").style.display="block";
   }
</script>

<script src="https://js.stripe.com/v3/"></script>
<script src="public/JS/StripePayment.JS"></script>
