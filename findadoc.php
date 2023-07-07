<?php

session_start();
$type=$_SESSION['type'];
include('header.php');
include('Connect.php');
if($type== "U")
{
  $type=$_SESSION['type'];

}
 ?>
<!DOCTYPE html>
<html lang="en">



 
  <!-- Find a Doctor-->

  <div class id="center" style="padding-top: 110px;">
  <p>Find A Doctor</p>
  </div>


    <title>Find Doc</title>
    <title>Awesome Search Box</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="assets/css/symptom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	

  <!-- Coded of the search bar-->
  <form autocomplete="off" action="#" method="GET">
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
          <input class="search_input" type="text" name="search_input" placeholder="Search..."	>
          <a href="findadoc.php" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>
    </div>
    </form><br><br><br>
    <table style="table-layout: fixed; width: 100%" class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Qualification</th>
                <th style=" width: 65%" scope="col">Address</th>
                <th scope="col">Experience</th> 
              </tr>
            </thead>
            <tbody>
             <?php 
		
			 if(isset($_GET['search_input']))
			{
				$search = mysqli_real_escape_string($db, $_GET['search_input']);
				$query = "SELECT * from doc_account WHERE Doc_Qualification LIKE '%".$search."%'";
				$search_result = filterTable($query);
			
			}
			else
			{				
				$query = "SELECT *FROM doc_account" ;
			    $search_result = filterTable($query);
			}
			function filterTable($query)
			{
				$db = mysqli_connect("localhost", "root", "", "hlo");
				$filter_Result = mysqli_query($db, $query);
				return $filter_Result;
			}
             
             ?>
			 <?php while($rows = mysqli_fetch_array($search_result)):?>
              <tr>
                <td><?php echo $rows['Doc_Name'];?></td> 
                <td><?php echo $rows['Doc_Qualification']; ?></td>
                <td style="word-wrap: break-word" ><?php echo $rows['Doc_Address']; ?></td>
                <td><?php echo $rows['Doc_Experience']; ?></td>
              </tr> 
           <?php endwhile;?>
            </tbody>
          </table>
<?php
include('footer.php');
?>


