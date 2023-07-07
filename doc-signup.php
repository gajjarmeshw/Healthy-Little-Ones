<?php 
session_start();

$db = mysqli_connect('localhost','root','','hlo') or die("could not connect to database");

include 'header.php';
?>
<head>
<title>
Doctor signup</title>
</head>
  
<?php
	$errors = array();
	
	if(isset($_POST['Submit'])){
	$files = "";
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$qualification = mysqli_real_escape_string($db, $_POST['qualification']);
	$experience = mysqli_real_escape_string($db, $_POST['experience']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password']);
	$password_2 = mysqli_real_escape_string($db, $_POST['confirm_password']);
	$token = bin2hex(random_bytes(15));

	$files = $_FILES['image'];

	$filename = $files['name'];
	$fileerror = $files['error'];
	$filetmp = $files['tmp_name'];

	$fileext = explode('.',$filename);
	$filecheck = strtolower(end($fileext));
	$fileexstored = array('png','jpg' ,'jpeg');
	
	if($password_1 != $password_2)
{
	array_push($errors, "Password do not match");
}
       
	$doc_check_query = "SELECT * FROM doc_account WHERE Doc_Email = '$email'";
	$result = mysqli_query($db, $doc_check_query);
	$doc = mysqli_fetch_assoc( $result);

	if($doc)
	{	
		if($doc['Doc_Email'] === $email ){
			array_push($errors, "Email id is already registered");
	}
}

	
if(count($errors) === 0)
	{
		$password = md5($password_1);
		if(in_array($filecheck,$fileexstored))
		{
			$destinationfile = 'upload/' .$filename;
			move_uploaded_file($filetmp,$destinationfile);
		
		
			$query = "INSERT INTO doc_account(Doc_Name,Doc_Qualification,Doc_Certificate,Doc_Experience,Doc_Address,Doc_Email,Doc_Pwd,Doc_Token,D_Valid) VALUES('$username','$qualification','$destinationfile','$experience','$address' ,'$email','$password','$token','inactive')";
			mysqli_query($db , $query);
echo $query;			
	
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
    			$mail->Body    = "Hi, $username. Click here to activate your account http://localhost/hlo/activatedoc.php?token=$token";
    			$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

    			$mail->send();
    	
				$_SESSION['msg'] = "Check mail to activate your account $email";	
				header("location: logindoc.php");

			} 
			catch (Exception $e) 
			{
    		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
			}	
		}

	}
}
include ('Errors.php');

?>

<body>
<div class="signup-form">
    <form action="doc-signup.php" method="post" class="form-horizontal" enctype = "multipart/form-data">
	
      	<div class="row">
        	<div class="col-8 offset-2">
                <h2>Doctor Registration.</h2>
            </div>	
            <p style="margin-left:12px;">Register here if you are a Doctor. Thank You</p>
      	</div>		
		<div>
		<p class= "bg-success text-white px-4"> 
	
	</p>
		</div>
				
        <div class="form-group row">
			<label class="col-form-label col-4">Username<span class="required"> *</span></label>
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
			<label class="col-form-label col-4">Qualification<span class="required"> *</span></label>
			<div class="col-8">
                <input type="tel" class="form-control" 
                name="qualification"
                id="qualification"
                required="required"
               />
            </div>        	
        </div>
        <div class="form-group row">
			<label class="col-form-label col-4">Certificate<span class="required"> *</span></label>
			<div class="col-8">
                <input type="file" name="image" id  = "image" class="form-control">
            </div>  
		</div>
		<div class="form-group row">
			<label class="col-form-label col-4">Experience<span class="required"> *</span></label>
			<div class="col-8">
                <input type="text"class="form-control" name="experience">
            </div>  
        </div>
		<div class="form-group row">
			<label class="col-form-label col-4">Address<span class="required"> *</span></label>
			<div class="col-8">
                <input type="text"class="form-control" name="address">
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
			<div class="form-group row">
				<div class="col-8 offset-4">
					<br><p><label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a>.</label></p>
					<button type="submit" name = "Submit" class="btn btn-primary btn-lg">Register</button>
					</div>
					<div class="text-center">Click Here <a href="signup.php">For User Registration & Login</a></div>
					<div class="center">Already have an account? <a href="logindoc.php">Login here</a></div>
			</div> 
					      
    </form>
</div>


</body>
</html>