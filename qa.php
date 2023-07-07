<?php

session_start();
$user = $_SESSION['name'];
$type = $_SESSION['type'];
if($type == "U"){

include("header.php");
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link href="qa.css" rel="stylesheet">
<div class="row shadow-lg p-3 mb-5 bg-white rounded">
    <div class="col-sm-4 text-center abc ">
        <!-- Default form login -->
        <form action="qastore.php" method="POST">
            <h1 class=" mb-4 text-left">Ask a Doctor online</h1>
            <p class="text-left">Post a question and get personalised answers emailed to you!</p> <!-- Email --> <label for="mail" class="in"><span class="bold">SUBMIT HEALTH QUERY</span> </label> <textarea id="defaultLoginFormEmail" name ="que"class="form-control mb-4" placeholder="Enter Username"rows="5"> </textarea>
            
          <hr><label for="age" class="in"><span class="bold">AGE</span> </label>
             <input style="margin-left:15px" name="age"class="in  mb-4" type="number" min="10" max="100"><br><hr>
             
               <label for="gender" class="in"><span class="bold">GENDER</span></label>
          <select style="margin-left:15px" class="in" name="gender" id="gender">
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    <option value="other">Other</option>
  </select><br><hr>
            
              <button class="btn btn-info btn-block " type="submit" name="submit" value="sent" style="background-color:#65c9cd"><span class="bold">Submit & continue</span></button> 
        </form>
        
    </div>
    <div class="col-sm-8 xyz text-center"><img src="iconfinder_medical_icon_3_1290986.png" alt="Doc image here">
    <h4><i class='fas fa-bell' style='font-size:25px;color:red'></i>   <b>1000</b> Doctors Registered with Us!
    </div>
</div>

<div class="row shadow-lg p-3 mb-5 bg-white rounded">
<p><b>NOTE:-</b> The questions asked are subject to review and will be displayed in our website. However,your username will not be revealed.<br> Please use appropriate language and be as specific as possible.<br> <b>Don't consider these questions as any official note or Prescription regarding the problems. These may serve as second opinions and generalised answers. </b>
</div>
<?php
include("footer.php");
}
else{
  include('404.html');
}
?>