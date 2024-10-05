<?php $title = 'Home'?>
<?php  $classes='Introsection'?>

        <link rel="stylesheet" type="text/css" href="public/css/videointrostyling.css">
        <link rel="stylesheet" type="text/css" href="public/css/statistcsStyle.css">
        <link rel="stylesheet" type="text/css" href="public/css/newrecipesstyling.css">
        <link rel="stylesheet" type="text/css" href="public/css/chefsStyling.css">


   <?php  include 'view/necessaryCompo.php'?>

   
       <video autoplay muted loop>
           <source src="resources/videos/bgVideo.mp4" type="video/mp4">
           Your browser does not support the video tag.
       </video>


       <?php  include 'view/nav.php'?>

       <div class="titlecontainer">
           <p class="smalltitle">Feeling hungry? Let's</p>
           <p class="bigtitle">Discover The real Tast of food</p>
           <a href="Reservation"><span>Book Table</span></a>
       </div>

   </section>
   
   <div class="servicescontainer">
       <div>
           <div class="serviceicon"> <i class="fa-solid fa-heart-pulse"></i></div>
           <p>Healthy food</p>
       </div>

       <div>
           <div class="serviceicon"><i class="fa-solid fa-bolt"></i></div>
           <p>Fast service</p>
       </div>

       <div>
           <div class="serviceicon"><i class="fa-solid fa-utensils"></i></div>
           <p>Tasty food</p>
       </div>
       <div>
           <div class="serviceicon"><i class="fa-regular fa-clock"></i>
           </div>
           <p> Time is time</p>
       </div>
   </div>
   <div class="statisticsSection">
       <div>
           <p><?php echo $statistics['clients'];?></p>
           <p>Clients</p>
       </div>
       <div>
           <p><?php echo $statistics['reservations'];?></p>
           <p>Reservations last week</p>
       </div>
       <div>
           <p><?php echo $statistics['chefs'];?></p>
           <p>chefs</p>
       </div>
       <div class="notthis">
           <p><?php echo $statistics['dishes'];?></p>
           <p>Dishes/drinks</p>
       </div>
   </div>

   <div class="newrecipescontainer">
       <div class="newsection_textcontent">
           <h3>What's new</h3>
               <h1>Our new recipes are waiting for you</h1>
               <p>try new tastes from all categories and from expert master chefs Lorem ipsum dolor sit amet consectetur adipisicing elit Magni autem obcaecati labore excepturi </p>
               <div class="btnscontainer"><button id="leftbtn"><i class="fa-solid fa-arrow-left-long"></i></button>
                 <button id="rightbtn"><i class="fa-solid fa-arrow-right-long"></i></button>
               </div>
       </div>
       <div class="newsection_imagecontent newsection_imagesformenu">
        <?php foreach($newFoods as $newFood) :?>
           <div> 
               <img src="<?php echo "data:image;base64,".base64_encode($newFood->getImage());?>">
               <div><?php echo $newFood->getFoodName();?></div>
           </div>
           <?php endforeach;?>
       </div>
   </div>

   <div class="reviewssection">
       <div class="comentscontainer">
          
       <p>What Our Customers Say</p>
       <p class="comment"><span class="fade"> sit amet lobortis nulla. Nunc ullamcorper, mi id luctus dictum, augue tortor dictum ipsum, nec congue arcu lorem in nisl. Duis neque lacus, viverra non mauris ac, pharetra rhoncus libero. Aliquam varius viverra ex, in venenatis magna ornare sit amet. Integer varius sit amet turpis eu ullamcorper.</span></p>
       <div class="cusimage"> <img class="fade" src="resources/images/client2.jpg"></div>
       <button id="nextreview"><i class="fa-solid fa-chevron-right"></i></button>
       <button id="previousreview"><i class="fa-solid fa-chevron-left"></i></button>
       <svg class="flowershape" width="177" height="139" viewBox="0 0 177 139" fill="none" xmlns="http://www.w3.org/2000/svg">
           <path opacity="0.1" d="M46.2675 -4.26877C46.2675 -4.26877 52.8851 -22.8601 72.123 -28.365C91.3609 -33.87 112.199 -27.9126 123.911 -10.3797C135.299 6.66698 136.097 24.7436 129.961 37.2434C124.007 49.3565 105.534 56.4832 105.534 56.4832M112.331 98.0199C112.331 98.0199 119.793 96.2018 127.969 105.911C138.428 118.334 129.978 136.774 129.978 136.774C127.39 127.601 114.737 130.265 103.52 128.688C92.3028 127.111 90.3116 111.769 92.0273 103.745C93.743 95.7207 101.12 90.1754 106.749 90.5796C111.636 90.93 110.702 99.7352 104.56 97.5022C95.4202 94.178 93.7832 80.7982 123.045 61.1434C152.306 41.4885 174.469 72.9283 174.469 72.9283C174.469 72.9283 168.94 72.0612 158.886 78.3515C148.834 84.6461 152.167 86.4556 139.161 91.441C126.154 96.4222 105.474 85.2031 105.474 85.2031M105.475 85.2074C105.475 85.2074 142.348 55.9609 152.491 65.1631C162.634 74.3653 119.558 69.8499 119.558 69.8499M99.8343 105.784C99.8343 105.784 117.789 115.273 120.43 117.526C123.07 119.78 122.082 125.287 118.126 124.261C114.165 123.233 112.093 104.964 112.093 104.964M127.094 78.198C127.094 78.198 134.484 77.3381 140.959 80.3983M-28.6235 35.5325C-23.4479 20.7264 -6.18066 3.21785 19.9274 -2.3833C46.0355 -7.98444 64.7061 -2.93865 80.5491 11.5271C96.3964 25.9915 106.881 62.0194 101.612 79.1592C96.3486 96.3017 85.7316 120.303 52.7757 129.994C21.0683 139.319 -9.50319 126.895 -25.8957 99.7427C-40.4535 75.6277 -33.8019 50.3442 -28.6235 35.5325ZM8.24337 57.9082C6.13394 59.6569 7.30411 65.4412 10.6987 65.2438C14.0947 65.0508 17.578 61.6863 15.9749 59.3967C14.3689 57.1129 10.7863 55.802 8.24337 57.9082ZM64.8743 23.2846C65.2809 20.7847 61.4904 18.0903 59.4594 20.5252C57.4241 22.9616 57.0059 27.3761 59.2201 27.6635C61.4385 27.9495 64.3843 26.2983 64.8743 23.2846ZM18.4359 78.0208C18.1427 80.5346 22.0492 83.0534 23.9696 80.5281C25.8901 78.0028 26.1098 73.5745 23.883 73.3904C21.6603 73.2049 18.7883 74.9918 18.4359 78.0208ZM101.604 -14.7367C100.906 -13.6727 107.845 -2.54426 105.034 -0.617343C102.223 1.30958 100.727 -2.05847 102.075 -3.00484C103.424 -3.94697 112.934 3.91484 114.11 3.07775C115.287 2.2449 109.044 -10.4046 111.833 -10.9136C114.625 -11.4282 115.816 -8.23644 114.214 -7.48771C112.614 -6.74465 102.302 -15.8008 101.604 -14.7367ZM44.7571 10.1173C50.1738 15.7635 44.2386 64.5861 36.9603 60.299C29.6834 56.0162 54.2331 13.3574 61.5819 12.5726C68.9307 11.7878 92.6652 36.2849 88.0068 44.0059C83.3483 51.7269 39.5915 70.1236 38.7833 65.0957C37.975 60.0679 81.417 45.9568 86.4073 52.0948C91.3977 58.2329 92.3233 62.778 91.2478 72.4325C90.1724 82.087 89.2916 94.5968 79.4186 95.7641C69.5499 96.93 35.6682 74.8007 39.9258 69.6673C44.1833 64.5339 70.7747 94.9254 69.2242 106.452C67.9347 116.06 35.4731 129.671 28.1676 118.198C19.6249 104.78 30.6213 71.1208 34.5126 71.7858C38.4038 72.4508 30.2191 112.194 15.0451 115.702C-0.130421 119.205 -15.6814 95.7671 -15.1793 85.1344C-14.6771 74.5017 27.9786 63.3808 30.4121 67.5155C32.8442 71.646 -15.4872 75.6551 -20.6434 71.6061C-25.7997 67.5571 -21.1057 30.7185 -6.18343 28.0829C8.73887 25.4473 36.7665 58.7456 33.3018 62.3492C29.8371 65.9528 -3.09236 29.8319 3.22644 18.512C9.54524 7.19217 37.3037 2.34082 44.7571 10.1173Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
       </svg>
       <p id="cusname"><span class="fade"> Badwi </span></p>
       </div>
   </div>


   <div class="chefsSection">
       <h3>Master Chefs</h3>
       <h1>Our Professional Chefs</h1>
         <div class="chefscontainer">
           <?php foreach($chefs as $chef):?>
           <div class="chefbox">
           <img src="<?php echo "data:image;base64,".base64_encode($chef->getImage());?>">
           <div class="chefinfos">
           <p class="chefname"><?php echo $chef->getChefFullName();?></p>
           <p class="chefgrade"><?php echo $chef->getLevel();?></p>
           <div><a href="<?php echo $chef->getFb();?>"><span><i class="fa-brands fa-facebook-f"></i></span></a> 
                <a href="<?php echo $chef->getIn();?>"><span><i class="fa-brands fa-linkedin-in"></i></span></a>
                <a href="<?php echo $chef->getIg();?>"><span><i class="fa-brands fa-instagram"></i></span></a>
            </div>
           </div>
        </div>
      <?php endforeach;?>       
      <div class="morechefsbtn"><a>View more</a></div>
        </div>
   </div>

   <?php include 'view/footer.php' ?>

   <script src="public/JSview/usefulscript1.js"></script>
   <script src="public/JS/HomeReview.JS"></script>


   </body>


