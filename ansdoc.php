<?php
session_start();
$user = $_SESSION['name'];
$type = $_SESSION['type'];
if($type == "D"){

    $id = $_GET['id'];
    include("connect.php");
  $sql = "SELECT * FROM que_doc where QueD_ID = '$id'";
  if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){  
    }
    else{
      include('header.php');
      echo '  
            <br><br><br><h1>Sorry no records found.</h1><hr>';
            include('footer.php'); 
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }
    
include("header.php");

?>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HLO</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/da6b9789f2.js" crossorigin="anonymous"></script>
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style>



   .btscol{
    background-color: #4CAF50; 
  border: none;
  color: white;
  padding: 6px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
   }
   .bts{
  background-color: white; 
  color: black; 
  border: 2px solid #3fbbc0;
}

.bts:hover {
  background-color: #3fbbc0;
  color: white;
}
</style>
</head>
<body>
    <div id="wrapper">
       <br><br><br><br>
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">           
            <ul class="nav" id="main-menu">	
                    
                    <li style="background-color:white">
                      <a class="active-menu"  href="Docpanel.php"><i class="fa fa-3x fa-question-circle" aria-hidden="true"></i>Answer Questions&emsp;&emsp;&emsp;&emsp;&emsp;</a>
                  </li>
                  <li>
                      <a  href="Addpost.php"><i class="fas fa-mail-bulk fa-3x"></i>Add Posts&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;</a>
                  </li>
                <li  >
                      <a  href="docedit.php"><i class="far fa-edit fa-3x"></i> Edit Info&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;</a>
                  </li>	
              </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Answer Questions</h2>   
                        <h5>Welcome  , Love to see you back. </h5>

      <div class="col-md-9 col-lg-10 main"><br>
        <h1 class="lead hidden-xs-down">Answer the Questions</h1>
        <table style="table-layout: fixed; width: 100%" class="table table-hover">
            <thead>
              <tr>
                <th  style=" width: 65%"scope="col">Question</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Created</th>
              
                
              </tr>
            </thead>
            <tbody>
             <?php 
              while($rows=$result->fetch_assoc())
              {
             ?>
              <tr>
                <td style="word-wrap: break-word" ><?php echo $rows['Que_Text'] ?></td>
                <td><?php echo $rows['age'] ?></td>
                <td><?php echo $rows['gender'] ?></td>
                <td><?php echo $rows['Created_AT'] ?></td><?php $ans = "ans"; ?>
              </tr> 
              <?php 
              }
              ?>
            </tbody>
          </table>
          <form action="ansdocb.php" method="POST">
          <div class="form-group">
    		        <label for="content">Answer Content</label><br>
    		       <textarea rows="10" id="description"class="form-control"name="acontent">
                    </textarea>
            </div>
    		    <div class="form-group">
             <input type="submit" name ="Answer" value="Send" class="bts btscol">
               <?php $_SESSION['id'] = $id; ?>  
    		    </div>
    		    
    		</form>
      
          </div>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <?php

}
else{
  include('404.html');
}
include("footer.php");
?>
