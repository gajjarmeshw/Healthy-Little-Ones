<?php
if(isset($_POST["submit"])){
session_start();
$user = $_SESSION['name'];
$type = $_SESSION['type'];

    include("connect.php");
  $sql = "SELECT * FROM user_account where User_Name = '$user'";
  if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
           $userID = $row['User_ID'];
        
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}

$que = $_POST['que'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$sql = "INSERT INTO que_doc (User_ID,Que_Text,que_st,age,gender) VALUES ($userID,'$que',0,'$age','$gender')";
if (mysqli_query($db, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

}
else{
  include('404.html');
}
mysqli_close($db);
?>
