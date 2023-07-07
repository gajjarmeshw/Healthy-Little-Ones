
<?php 

#registration
session_start();
$email = "";
$username = "";
$token = bin2hex(random_bytes(15));
$errors = array();

$db = mysqli_connect('localhost','root','','hlo') or die("could not connect to database");

		if(isset($_POST['signup_user'])){
	
$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$password_1 = mysqli_real_escape_string($db, $_POST['password']);
$password_2 = mysqli_real_escape_string($db, $_POST['confirm_password']);



if(empty($username))
{
	array_push($errors, "Username is required");
}
if(empty($email))
{
	array_push($errors, "Email is required");
	}
if(empty($password_1))
{
	array_push($errors, "Password is required");
}
if($password_1 != $password_2)
{
	array_push($errors, "Password do not match");
}
$user_check_query = "SELECT * FROM user_account WHERE User_Email = '$email'";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc( $result);

if($user)
{
	if($user['User_Email'] === $email)
	{
		array_push($errors, "Email id is already registered");
	}
	if($user['User_Name'] === $username)
	{
		array_push($errors, "Username is already registered");
	}
	
}

if(count($errors) === 0)
	{
	#$password = password_hash($password_1,PASSWORD_BCRYPT);
	$password = md5($password_1);
	$query = "INSERT INTO user_account(User_Name,User_Email,User_Pwd,User_Token,U_Valid) VALUES('$username','$email','$password','$token','inactive')";
	
	mysqli_query($db, $query);
	if($query){
		
		$subject = "Email Activation";
		$body = "Hi, $username. Click here to activate your account http://localhost/hlo/activate.php?token=$token";
		$sender_email = "From: healthylittleservices@gmail.com";

		if (mail($email, $subject, $body, $sender_email)) {
			$_SESSION['msg'] = "Check mail to activate your account $email";
			
			header("location: login.php");
	}
		
	else {
				echo "Email sending failed...";
			}
		}	
	}
}

#loginuser

if(isset($_POST['login_user'])){
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password']);	
	if(empty($email)){
		array_push($errors, "Email is required");
	}
	if(empty($password_1)){
		array_push($errors, "Password is required");
	}
	if(count($errors) == 0 ){
		#$password = password_hash($password_1,PASSWORD_BCRYPT);
		$password = md5($password_1);
		$query = "SELECT * FROM user_account WHERE User_Email='$email' AND User_Pwd='$password_1' and U_Valid='active'";
		$result = mysqli_query($db, $query);
			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_array($result);
				$user = $row['User_Name'];
				$_SESSION['name'] = $user;
				$_SESSION['type'] = "U";
				header("location: index.html");
			}
			else{
				array_push($errors, "Wrong username or password");
			}
	}
}

#forgot password
/*if(isset($_POST['Submit-email']))
{
	$email=mysqli_real_escape_string($db,$_POST['email']);
	
	$emailquery="SELECT * FROM user_account WHERE User_Email ='$email'";
	
	$query= mysqli_query($db, $emailquery);

	$userdata=mysqli_fetch_assoc($query);
	
	if($userdata>0)
    {
          $username = $userdata['User_Name'];
          $subject = "Password Reset";
		  $token1 = $userdata['User_Token'];
          $body= "Hii,$username. Click here to reset your password
          http://localhost/hlo/forgotpass1.php?token=$token1";
          $sender_email="From: healthylittleservices@gmail.com";
          if(mail($email,$subject,$body,$sender_email))
          {
              $_SESSION['msg']="check your mail to activate your account $email";
              header('location: login.php');
          }
          else
          {
              echo"email sending failed";
          }

    }
}

*/
#forgot password confirm	  
/*if(isset($_POST['submit-password']))
         {
			 if(isset($_GET['token'])){
				
			$token = mysqli_real_escape_string($db, $_POST['token']);
			
			 }
			 $newpassword = mysqli_real_escape_string($db,$_POST['forgot']);
			 $cpassword = mysqli_real_escape_string($db,$_POST['forgot1']);
			 $pass = md5($newpassword);
			 $cpass = md5($cpassword);
			 
			 if($newpassword === $cpassword)
			 {
				$updatequery="UPDATE user_account SET User_Pwd='$pass' Where User_Token='$token'";
				 $iquery= mysqli_query($db ,$updatequery);

				 if($iquery)
				 {
					  $_SESSION['msg']="your password has been updated";
					  header('location:login.php');
				 }
				 else
				 {
					  $_SESSION['msg']="your password is not updated";
					  header('location:forgotpass.php');
				 }
			 }
			 else
			 {
				$_SESSION['msg']="your password is not updated";
				echo"password are not matching";
			 }
			
			}
			else{
				echo"no token found";
			}
*/
include('Errors.php') 

?>