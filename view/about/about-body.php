
<!--les contact-->
<div class="contact">
        <div>
            <div class="contact-icon"> <i class="fa-solid fa-phone"></i></div>
            <p>0678964324</p>
        </div>
        <div>
            <div class="contact-icon"><i class="fa-sharp fa-solid fa-envelope"></i></div>
            <p>Haos@gmail.com</p>
        </div>
        <div>
            <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></i></div>
            <p> Quartier hassan2 oued zem</p>
        </div>
</div> 


<!-- About section-->

<section id="about-section">
  <!-- about left  -->
  <div class="about-left">
      <img src="resources/images/about-two.png" alt="About Img"/>
  </div>

  <!-- about right  -->
  <div class="about-right">
      <h4 style="font-family: littletext; color: var(--bigtextcolor);">History</h4>
      <h1>About Us</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
          Debitis fugiat a dolorem at similique maxime dolorum dolore
          enim dicta voluptatibus, illum recusandae, vel optio tempore
          ipsum incidunt eum. Aspernatur, repellendus.
      </p>
      <div class="address">
          <ul>
              <li>
                  <span class="address-logo">
                      <i class="fas fa-paper-plane"></i>
                  </span>
                  <p>Address</p>
                  <span class="saprater">:</span>
                  <p>Jaipur, Rajasthan, India</p>
              </li>
              <li>
                  <span class="address-logo">
                      <i class="fas fa-phone-alt"></i>
                  </span>
                  <p>Phone No</p>
                  <span class="saprater">:</span>
                  <p>+91 987-654-4321</p>
              </li>
              <li>
                  <span class="address-logo">
                      <i class="far fa-envelope"></i>
                  </span>
                  <p>Email ID</p>
                  <span class="saprater">:</span>
                  <p>crowncoder@gmail.com</p>
              </li>
          </ul>
      </div>
      <div>
        <button>Learn more</button>
      </div>
  </div>
</section>


<!--l'hocalisation-->

<div class="localidation">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13405.450694559!2d-6.564092846166696!3d32.86212245354275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda403f7c80133b9%3A0x396ee697c1b6a135!2sHaos!5e0!3m2!1sar!2sma!4v1708007946600!5m2!1sar!2sma" 
  width="100%" height="550" style="border:0; margin: 100px auto;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
  </iframe>
  </div> 

<!--les chefs-->


<div class="chefsSection">
    <h3>Master Chefs</h3>
    <h1>Our Professional Chefs</h1>
      <div class="chefscontainer">
        <?php foreach($allchefs as $chef):?>
        <div class="chefbox">
        <img src="<?php echo "data:image;base64,".base64_encode($chef->getImage());?>">
        <div class="chefinfos">
          <p class="chefname"><?php echo $chef->getChefFullName()?></p>
          <p class="chefgrade"><?php echo $chef->getLevel()?></p>
          <div><a href="<?php echo $chef->getFb();?>"><span><i class="fa-brands fa-facebook-f"></i></span></a> 
                <a href="<?php echo $chef->getIn();?>"><span><i class="fa-brands fa-linkedin-in"></i></span></a>
                <a href="<?php echo $chef->getIg();?>"><span><i class="fa-brands fa-instagram"></i></span></a>
            </div>
        </div>
     </div>
     <?php endforeach;?>

     
      
    </div>
  </div>

