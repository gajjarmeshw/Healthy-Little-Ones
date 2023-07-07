<!DOCTYPE html>
<?php
$bmi = "";
$bmicontent = "";
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BMI</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">


 <link href="assets/css/h&f.css" rel="stylesheet">
 <link href="assets/css/Bmi.css" rel="stylesheet">

 <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </head>

 <body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <i class="icofont-colock-time"></i>
      </div>
      <div class="d-flex align-items-center">
        <!--
        -->
      </div>
    </div>
  </div>
 
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.html" class="logo mr-auto"><img src="assets/img/log.png" alt=""></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.html">Home</a></li>

          <li><a href="#services">Symptom checker</a></li>
          <li><a href="#departments">Q&A</a></li>
          <li><a href="#doctors">Find A doctor</a></li>

           <li class="drop-down"><a href="">Health tools</a>
          <ul>
            <li><a href="#">BMI</a></li>
            <li><a href="#">Due Date Calculator</a></li>
            <li><a href="#">Vaccine Reminder</a></li>
            <li><a href="#">Teething Guide</a></li>
          </ul>
        </li> 
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav><!-- .nav-menu -->

      <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline"></span> Login</a>

    </div>
  </header><!-- End Header -->
  <?php
 
 if($_POST!=null)
 {
     $h=empty($_POST["height"]) ? 0 : $_POST["height"];
     $w=empty($_POST["weight"]) ? 0 : $_POST["weight"];
     $index =0;
     if($h !=0 && $w !=0)
         $index = round($w/($h*$h)* 703,2);
  
     $bmi="";
     $bmiStyle="alert alert-primary";
     if ($index < 18.5) {
         $bmi="Underweight - BMI : " . $index;
		 $bmicontent = "Eat more frequently. When you're underweight, you may feel full faster. Eat five to six smaller meals during the day rather than two or three large meals.
Choose nutrient-rich foods. As part of an overall healthy diet, choose whole-grain breads, pastas and cereals; fruits and vegetables; dairy products; lean protein sources; and nuts and seeds.";
         $bmiStyle="alert alert-secondary";
     } else if ($index < 25) {
         $bmi="Normal - BMI : ". $index;
		 $bmicontent="Maintaining a healthy BMI, it's important to exercise at least 60-90 minutes most days of the week. Stay hydrated and eat a balanced diet.";
         $bmiStyle="alert alert-success";
     } else if ($index < 30) {
         $bmi="Overweight - BMI : " . $index;
		 $bmicontent="Burn calories and maintain weight loss with daily workouts, cycling, swimming, etc.A diet is recommended that reduces ≥500 kcal/d [usually 1200 to 1500 kcal/d for women and 1500 to 1800 kcal/d for men]";
         $bmiStyle="alert alert-warning";
     } else {
         $bmi="Obese - BMI : " .$index;  
		 $bmicontent="Change your diet.Consider adding physical activity after reaching a minimum of 10 percent weight-loss goal.A diet is recommended that reduces ≥500 kcal/d [usually 1200 to 1500 kcal/d for women and 1500 to 1800 kcal/d for men]";
         $bmiStyle="alert alert-danger";
     }
 }
  
 ?>
 

 <!--BMI-->
 <div class id="cen">
 <h1>BODY MASS INDEX (BMI)</h1>
 </div>

 <div class="container">
  <form method="post">
      <div class="form-group">
        <label for="height">Please Enter your Height in Inches :</label>
        <input type="text" class="form-control" name="height" placeholder="60">
      </div>
      <div class="form-group">
        <label for="weight">Please Enter your weight in Pounds :</label>
        <input type="text" class="form-control"  name="weight" placeholder="150">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">Calculate</button>
      </div>
    </form>
    <div class="<?=$bmiStyle?>" role="alert" id="bmi">
      <?php 
      echo $bmi ; 
	  echo "</br>";
	  echo $bmicontent;
      ?>
  </div>
</div> 
 <center><img src="https://img.freepik.com/free-vector/man-body-mass-index-fitness-bmi-chart-with-male-silhouettes-scale_53562-7067.jpg?size=664&ext=jpg" alt="chart of Bmi" class ="cen" style="width:800px;height:450px; padding-top: 12px;"></center>
 <!--bmi ends here-->
 <!-- ======= Contact Section ======= -->
 <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contact</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

    </div>

    <div>
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.909616971649!2d72.54253881480084!3d23.027090584950823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84e8f8295a89%3A0xbbc57db3ec7081c2!2sGovernment%20Polytechnic%20Ahmedabad!5e0!3m2!1sen!2sin!4v1609324351227!5m2!1sen!2sin" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="container">

      <div class="row mt-5">

        <div class="col-lg-6">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Our Address</h3>
                <p>Government Polytechnic, Panjarapole Cross Rd, Panjara Pol, Ambawadi, Ahmedabad, Gujarat 380015</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-envelope"></i>
                <h3>Email Us</h3>
                <p>info@example.com<br>contact@example.com</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-phone-call"></i>
                <h3>Call Us</h3>
                <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="form-row">
              <div class="col form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validate"></div>
              </div>
              <div class="col form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validate"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please writeomething for us" placeholder="Message"></textarea>
              <div class="validate"></div>
            </div>
            <div class="mb-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="footer-info">
            <h3>Healthy Little Ones</h3>
            <p>
              <strong>Phone:</strong> +917984207750<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Visit Us</h4>
          <ul>
            <li>Government Polytechnic,<br> Panjarapole Cross Rd,<br> Ambawadi, <br>Ahmedabad, <br>Gujarat-380015</li>
          </ul>

        </div>
        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
          <form action="" method="post">
            <input type="email" name="email"><input type="submit" value="Subscribe">
          </form>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>Healthy Little Ones</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counterup/counterup.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
</body>
</html>