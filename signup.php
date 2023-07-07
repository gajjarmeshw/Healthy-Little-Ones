<?php 

session_start();
$db = mysqli_connect('localhost','root','','hlo') or die("could not connect to database");
include('header.php');
?>


<?php 

#Variable Declaration

$email = "";
$username = "";
$token = bin2hex(random_bytes(15));
$errors = array();

#Sign-up Backend

if(isset($_POST['signup_user']))
{	
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password']);
	$password_2 = mysqli_real_escape_string($db, $_POST['confirm_password']);


	#If Password Same

	if($password_1 != $password_2)
	{
		array_push($errors, "Password do not match");
	}

	#if user exists or not

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
		$password = md5($password_1);
		
		$query = "INSERT INTO user_account(User_Name,User_Email,User_Pwd,User_Token,U_Valid) VALUES('$username','$email','$password','$token','inactive')";
	
		mysqli_query($db, $query);
		
		if($query)
		{
			//Email ACTIVATION
			require 'PHPMailer/PHPMailerAutoload.php';

			//Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try 
			{
    			//Server settings
   				//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
   				$mail->isSMTP();                                            //Send using SMTP
    			$mail->Host       = 'smtp.gmail.com;';                     //Set the SMTP server to send through
    			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    			$mail->Username   = 'healthylittleservices@gmail.com';                     //SMTP username
    			$mail->Password   = 'Healthy@strong';                               //SMTP password
    			$mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    			$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    			//Recipients
    			$mail->setFrom('healthylittleservices@gmail.com', 'From Healthy Little Services');
    			$mail->addAddress($email,$username);     //Add a recipient
    
   				//Attachments
   				//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   				//Content
    			$mail->isHTML(true);                                  //Set email format to HTML
    			$mail->Subject = "Email Activation";
    			$mail->Body    = "Hi, $username. Click here to activate your account http://localhost/hlo/activate.php?token=$token";
    			$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

    			$mail->send();
    	
				$_SESSION['msg'] = "Check mail to activate your account $email";	
				header("location: login.php");

			} 
			catch (Exception $e) 
			{
    		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
			
		}
	}
}
include 'Errors.php';
?>

<div class="signup-form">
    <form action="signup.php" method="post" class="form-horizontal">
      	
		<div class="row">
        	<div class="col-8 offset-4">
				<h2>Sign Up</h2>
			</div>	
      	</div>		
		  <p style="margin-left:12px;">Register here and get the benifits by various features provided by us.</p>	
		<div class="form-group row">
			<label class="col-form-label col-4">User Name<span class="required"> *</span></label>
			<div class="col-8">
                <input type="text" class="form-control" name="username" required="required">
            </div> 
		</div>
		<div class="form-group row">
			<label class="col-form-label col-4">Email Address<span class="required"> *</span></label>
			<div class="col-8">
                <input type="email" class="form-control" name="email" required="required">
            </div>        	
        </div>
		<div class="form-group row">
			<label class="col-form-label col-4">Password<span class="required"> *</span></label>
			<div class="col-8">
                <input type="password" class="form-control" name="password" required="required">
            </div>        	
        </div>
		<div class="form-group row">
			<label class="col-form-label col-4">Confirm Password<span class="required"> *</span></label>
			<div class="col-8">
                <input type="password" class="form-control" name="confirm_password" required="required">
            </div>        	
        </div>
		<div class="form-group row">
			<div class="col-8 offset-4">
				<p><label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a>.</label></p>
				<button type="submit" class="btn btn-primary btn-lg" name= "signup_user">Sign Up</button>
				<div class="text-center,padding-top:2px">Already have an account? <a href="login.php">Login here</a></div>
				
				<div class="center"><a href="doc-signup.php">Click For Doctor Registration & Login</a></div>
			</div>  
		</div>		      
    </form>

</div>
</body>
</html>