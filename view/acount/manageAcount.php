<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>account settings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="public/css/colors.css" rel="stylesheet">
<style type="text/css">
    	body{
    background: #f5f5f5;
    margin-top:20px;
    overflow-x: hidden;
}

.ui-w-80 {
    width: 80px !important;
    height: auto;
}

.btn-default {
    border-color: rgba(24,28,33,0.1);
    background: rgba(0,0,0,0);
    color: #4E5155;
}

label.btn {
    margin-bottom: 0;
}

.btn-outline-primary {
    border-color: var(--secondcolor);
    background: transparent;
    color: var(--secondcolor);
}

.btn {
    cursor: pointer;
}

.text-light {
    color: #babbbc !important;
}

.btn-facebook {
    border-color: rgba(0,0,0,0);
    background: #3B5998;
    color: #fff;
}

.btn-instagram {
    border-color: rgba(0,0,0,0);
    background: #000;
    color: #fff;
}

.card {
    background-clip: padding-box;
    box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.row-bordered {
    overflow: hidden;
}

.account-settings-fileinput {
    position: absolute;
    visibility: hidden;
    width: 1px;
    height: 1px;
    opacity: 0;
}
.account-settings-links .list-group-item.active {
    font-weight: bold !important;
}
html:not(.dark-style) .account-settings-links .list-group-item.active {
    background: transparent !important;
}
.account-settings-multiselect ~ .select2-container {
    width: 100% !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.material-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.material-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.dark-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(255, 255, 255, 0.03) !important;
}
.dark-style .account-settings-links .list-group-item.active {
    color: #fff !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4E5155 !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24,28,33,0.03) !important;
}
.red{
    color: red !important;
}

.succes {
  background-color: #4BB543;
}
.succes-animation {
  animation: succes-pulse 2s infinite;
}

.danger {
  background-color: #CA0B00;
}
.danger-animation {
  animation: danger-pulse 2s infinite;
}

.custom-modal {
  position: relative;
  width: 350px;
  min-height: 250px;
  background-color: #fff;
  border-radius: 30px;
  margin: 40px 10px;
}
.custom-modal .content { 
  position: absolute;
  width: 100%;
  text-align: center;
  bottom: 0;
}
.custom-modal .content .type {
  font-size: 18px;
  color: #999;
}
.custom-modal .content .message-type {
  font-size: 24px;
  color: #000;
}
.custom-modal .border-bottom {
  position: absolute;
  width: 300px;
  height: 20px;
  border-radius: 0 0 30px 30px;
  bottom: -20px;
  margin: 0 25px;
}
.custom-modal .icon-top {
  position: absolute;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  top: -30px;
  margin: 0 125px;
  font-size: 30px;
  color: #fff;
  line-height: 100px;
  text-align: center;
}
@keyframes succes-pulse { 
  0% {
    box-shadow: 0px 0px 30px 20px rgba(75, 181, 67, .2);
  }
  50% {
    box-shadow: 0px 0px 30px 20px rgba(75, 181, 67, .4);
  }
  100% {
    box-shadow: 0px 0px 30px 20px rgba(75, 181, 67, .2);
  }
}
@keyframes danger-pulse { 
  0% {
    box-shadow: 0px 0px 30px 20px rgba(202, 11, 0, .2);
  }
  50% {
    box-shadow: 0px 0px 30px 20px rgba(202, 11, 0, .4);
  }
  100% {
    box-shadow: 0px 0px 30px 20px rgba(202, 11, 0, .2);
  }
}
body{
    position: relative;
}

.custom-modal{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    box-shadow: 0 0 5px rgba(0, 0,0,0.3);
    display: none;
}
    </style>
</head>
<body>
   
<div class="container light-style flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-4">
Account settings
</h4>
<div class="card overflow-hidden">
<div class="row no-gutters row-bordered row-border-light">
<div class="col-md-3 pt-0">
<div class="list-group list-group-flush account-settings-links">
<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
</div>
</div>
<div class="col-md-9">
<div class="tab-content">
<div class="tab-pane fade active show" id="account-general">
<div class="card-body media align-items-center">
    <?php 
       $link='https://bootdey.com/img/Content/avatar/avatar1.png';
      if($client->getImage()!=null){ 
        $clientImage = $client->getImage();
           $link="data:image;base64,".base64_encode($clientImage);
         }
        ?>
       
<img src="<?php echo $link;?>" alt class="d-block ui-w-80" id="clientImage">
<div class="media-body ml-4">
<label class="btn btn-outline-primary">
Upload new photo
<input type="file" class="account-settings-fileinput" accept="image/*">
</label> &nbsp;
<button type="button" class="btn btn-default md-btn-flat" id="resetbtn">Reset</button>
<div class="text-light cond small mt-1">Allowed JPG, GIF or PNG ... Max size of 1mb</div>
</div>
</div>
<hr class="border-light m-0">
<div class="card-body">
<div class="form-group">
<label class="form-label">First Name</label>
<input type="text" class="form-control mb-1" value="<?=$client->getFirstName()?>" id="firstname" name="firstname">
</div>
<div class="form-group">
<label class="form-label">Last Name</label>
<input type="text" class="form-control" value="<?=$client->getLastName()?>" id="lastname">
</div>


</div>
</div>

<div class="tab-pane fade" id="account-change-password">
<div class="card-body pb-2">
<div class="form-group">
<label class="form-label">Current password</label>
<input type="password" class="form-control" id="curPass">
</div>
<div class="form-group">
<label class="form-label">New password</label>
<input type="password" class="form-control" id="newPass">
</div>
<div class="form-group">
<label class="form-label">Repeat new password</label>
<input type="password" class="form-control" id="confNewPass">
</div>
</div>
</div>








</div>
</div>
</div>
</div>
<div class="text-right mt-3">
<button type="button" class="btn btn-primary" style="background-color: var(--secondcolor); border-color: var(--secondcolor);" onclick="checkClientInfos()">Save changes</button>&nbsp;
<button type="button" class="btn btn-default">Cancel</button>
</div>
</div>

 <div class="row justify-content-center mt-5 tablecont" >
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 "style="background-color: #fff !important;" >
        <h6 class="pt-5 pl-2" style="color: var(--secondcolor); background-color: #fff;"> Reservation history</h6>

   
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Persons</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
              <?php foreach($reservations as $reservation) :?>
                  <tr>
                    <td><?php echo $reservation->getIdReservation();?></td>
                    <td><?php echo $reservation->TP?>$</td>
                    <td><?php echo $reservation->getDate();?></td>
                    <td><?php echo $reservation->getTime();?></td>
                    <td><?php echo $reservation->getPersons();?></td>
                    <td class="resState"><?php echo $reservation->getStatus();?></td>
                  </tr>
                  <?php endforeach;?>
                  </tbody>
              </table>
              </div>
    </div>

    


  <div class="custom-modal suc">
    <div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div>
    <div class="succes border-bottom"></div>
    <div class="content">
      <p class="type">Appointment</p>
      <p class="message-type sucmsg"></p>
    </div>
  </div>
  
  <div class="custom-modal failed">
    <div class="danger danger-animation icon-top"><i class="fa fa-times"></i></div>
    <div class="danger border-bottom"></div>
    <div class="content">
      <p class="type">Appointment</p>
      <p class="message-type errmsg">A Problem Occurred </p>
    </div>
  </div>




<script src="public/JSview/manageaccount.js"></script>
<script src="public/JS/acountManagement.js"></script>

</script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js">
</script>


</script>
</body>
</html>