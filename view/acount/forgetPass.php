
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/forgetPassStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/colors.css">

    <title>Forget password</title>
</head>

<body>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
  function onSubmit(token) {
    checkgmail(token);
  }
</script>

<div class="form-container">
  <form class="form" action="sendGVcode" method="post" >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="lock-icon"
      width="1em"
      height="1em"
      viewBox="0 0 24 24"
      stroke-width="0"
      fill="currentColor"
      stroke="currentColor"
    >
      <path
        d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7zm4 10.723V20h-2v-2.277a1.993 1.993 0 0 1 .567-3.677A2.001 2.001 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723z"
      ></path>
    </svg>
    <input class="toggle-input" id="toggle-checkbox" type="checkbox" />
    <p class="form-title">Enter your gmail</p>
    <p class="form-sub-title">
    Enter a gmail you have logged with below
    </p>
    <div class="login-card">
      <div class="field-container">
      <svg xmlns="http://www.w3.org/2000/svg" class="excl" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
        <input placeholder="" class="input" type="email" name="email" id="email" required/>
        <span class="placeholder">Gmail</span>
      </div>

      <button class="btn g-recaptcha" data-sitekey="6LdLQ48pAAAAAM9W_SCqY_1h8eSrYYtviuMbwljz" data-callback='onSubmit' data-action='submit' id="check"  type="submit" >
        <span class="btn-label" for="toggle-checkbox" >Continue</label>
      </button>
    </div>
  </form>
</div>

<svg viewBox="25 25 50 50" class="svgloader">
  <circle r="20" cy="50" cx="50"></circle>
   </svg>



<script src="public/JS/checkInfos.js"></script>

</body>
</html>