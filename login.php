<?php
session_start();
require_once('phpmailer/PHPMailerAutoload.php');
//include_once('include/header.php');
 ?>
<?php
require_once("class.user.php");
//$user = new USER();

$login = new USER();


if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

else if($login->is_loggedin()!="")
{
//  echo "Wrong email or password";
	$login->redirect('login.php');
}

if(isset($_POST['btn-login']))
{ // strip tags ura diye mae ne xss security bhaar mae jaye filhaal
	$email = strip_tags($_POST['email']);
//	$phoneNo = strip_tags($_POST['phoneNo']);
	$password = strip_tags($_POST['password']);

	if($login->doLogin($email,$password))
	{
    if($login->getFlag()!=1){
      $email = $login->getEmailofUser();
      $code = rand(102932, 780923);
      $login->insertRandomNumber($code);
      if($email!=-1){
        sendMail($email, $code);
      }

		$login->redirect('verify.php');
  }
  else{
    $login->redirect('person.php');
  }

  }
	else
	{
		$error = " Wrong Email Or Password Details !";
	}
}
?>
<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
<link rel="shortcut icon" href="favicon.png" />
    <title>Emergency Blood Donation System | Homepage</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->

   <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
   <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" href="assets/plugins/revolution_slider/css/rs-style.css" media="screen">
   <link rel="stylesheet" href="assets/plugins/revolution_slider/rs-plugin/css/settings.css" media="screen">
   <link href="assets/plugins/bxslider/jquery.bxslider.css" rel="stylesheet" />
   <!-- END PAGE LEVEL PLUGIN STYLES -->

   <!-- BEGIN THEME STYLES -->
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->


</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body>
	<!-- BEGIN STYLE CUSTOMIZER -->
	<!-- END BEGIN STYLE CUSTOMIZER -->

    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<button class="navbar-toggle btn navbar-btn" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN LOGO (you can use logo image instead of text)-->
				<a class="navbar-brand logo-v1" href="index.html">
					<img src="assets/img/logo_blue.png" id="logoimg" alt="">
				</a>
				<!-- END LOGO -->
			</div>

			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li>
      <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="index.php">
                        	Home

                        </a>

					</li>

                    <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                            Our Organization
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>

                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Gallery</a></li>
                            <li><a href="#">Fatimid Foundation</a></li>
                            <li><a href="#">Benefits of Blood Donation</a></li>

                        </ul>
                    </li>
					<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                        	Features
                        	<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                        	<li><a href="search.php">Search For Blood</a></li>
                        	<li><a href="dsearch.php">Donate Blood</a></li>
                        	<li><a href="downloadapp.php">Download Mobile App</a></li>
                        	<li><a href="#">Suggestions</a></li>
                        </ul>
					</li>

					<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                        	Signup|Login
                        	<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                        	<li><a href="login.php">Signin</a></li>
                        	<li><a href="signup.php">Register</a></li>
                        </ul>
					</li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                            Contact Us
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="#">Contact</a></li>
                        </ul>
                    </li>


				</ul>
			</div>
			<!-- BEGIN TOP NAVIGATION MENU -->
		</div>
    </div>
    <!-- END HEADER -->

<div class="page-container">

        <!-- BEGIN BREADCRUMBS -->
        <div class="row breadcrumbs margin-bottom-40">
            <div class="container">
                <div class="col-md-4 col-sm-4">

                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="">Pages</a></li>
                        <li class="active">Login</li>
                    </ul>

                </div>
            </div>
        </div>

        <!-- END BREADCRUMBS -->

        <!-- BEGIN CONTAINER -->
        <div class="container margin-bottom-40">
          <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 login-signup-page">
                <form method="post" >

                    <h2>Login to your account</h2>

                    <?php
                      if(isset($error))
                     {
                    //Bootstrap apne wali warning class
                     ?>
                     <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                    </div>
                    <?php
                    //apne wali khatam
                    }
                    ?>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control" name="email" placeholder="E-mail">
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password">

                        <a href="#" class="login-signup-forgot-link">Forgot?</a>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <div class="checkbox-list">
                                 <label>
                                 <div class="checker"><span class=""><input type="checkbox"></span> Remember Me</div>
                                 </label>

                          </div> </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn theme-btn pull-right" name="btn-login">Login</button>
                        </div>
                    </div>

                    <hr>

                    <div class="login-socio">
                        <p class="text-muted">Or Signup here :</p>
                        <div class="col-md-8 col-sm-8">

                        <a href="signup.php">  <button type="button" class="btn btn-warning">Sign Up</button> </a>
                        </div>

                        <ul class="social-icons">
                          <li><a  href="#"></a></li>
                          <li><a   href="#"></a></li>
                            <li><a  href="#"></a></li>

                                                    </ul>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <!-- END CONTAINER -->

  </div>
    <!-- END PAGE CONTAINER -->


<?php
include_once('include/footer.php');

?>
<?php
function sendMail($email, $code){
  $mail = new PHPMailer;

  //Enable SMTP debugging.
  $mail->SMTPDebug = 0;
  //Set PHPMailer to use SMTP.
  $mail->isSMTP();
  //Set SMTP host name
  $mail->Host = "smtp.gmail.com";
  //Set this to true if SMTP host requires authentication to send email
  $mail->SMTPAuth = true;
  //Provide username and password
  $mail->Username = "bloodtodayorg@gmail.com";
  $mail->Password = "ilovepakistan1";
  //If SMTP requires TLS encryption then set it
  $mail->SMTPSecure = "tls";
  //Set TCP port to connect to
  $mail->Port = 587;

  $mail->From = "no-reply@bloodtodayorg.com";
  $mail->FromName = "Blood Today Organization";

  $mail->addAddress($email, "Email Confirmation");

  $mail->isHTML(true);

  $mail->Subject = "Email Confirmation";
  $mail->Body = "Hello Sir, <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;This is your verification code <b>".$code."</b>. <hr>
  Thanks for using our services.";
  $mail->AltBody = "Hello Sir, This is your verification code. ".$code."Thanks for using our services.";

  if(!$mail->send())
  {
  echo "Mailer Error: " . $mail->ErrorInfo;
  }
  else
  {

	   echo "Message has been sent successfully";
  }

}

?>
