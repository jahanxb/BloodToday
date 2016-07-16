<?php
require_once('phpmailer/PHPMailerAutoload.php');
//require_once('class.user.php');
//session_start();

//error_reporting(0);

//session_start();
//include_once('include/header.php');
	require_once("session.php");
	require_once("class.user.php");

	$auth_user = new USER();
$person = new USER();

	$userID = $_SESSION['user_session'];
	$user = new USER();
	if($user->getFlag()==0){
	  $user->redirect('verify.php');
	}



	$stmt = $auth_user->runQuery("SELECT * FROM user WHERE userID=:userID");
	$stmt->execute(array(":userID"=>$userID));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	$stupid_id=$userRow['userID'];

	$stmt1 = $auth_user->runQuery("SELECT PersonID FROM person WHERE user_userID=:user_userID");
	$stmt1->execute(array(":user_userID"=>$userID));
	$userRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
	$stupid_id_P=$userRow1['PersonID'];
	$person->checkPerson($stupid_id_P);

//$person_user_id=strip_tags($userRow['userID']);


  if(isset($_POST['btn-submit']))
  {

  $FirstName= strip_tags($_POST['FirstName']);
  $LastName= strip_tags($_POST['LastName']);
  $Date_of_birth= strip_tags($_POST['Date_of_birth']);
  $Gender= strip_tags($_POST['Gender']);
  $bloodGroup= strip_tags($_POST['bloodGroup']);
//$user_userID=$stupid_id;
	$user_userID=strip_tags($_POST['u_fk_id']);
//$user_userID=strip_tags($_POST($userRow['userID']));


  		try
  		{
//  			$stmt = $user->runQuery("SELECT userID,PersonID FROM user,person");
  //			$stmt->execute(array(':email'=>$email, ':phoneNo'=>$phoneNo));
  //			$row=$stmt->fetch(PDO::FETCH_ASSOC);

  				if($person->registerPerson($FirstName,$LastName,$Date_of_birth,$Gender,$bloodGroup,$user_userID)){
  				$person->redirect('home.php');
  				}
  			}

  		catch(PDOException $e)
  		{
  			echo $e->getMessage();
  		}
}
?>







<!DOCTYPE html>
<html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
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

 <link rel="shortcut icon" href="favicon.png" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>



</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->

<body>
	<!-- BEGIN STYLE CUSTOMIZER -->
	<!-- END BEGIN STYLE CUSTOMIZER -->

    <!-- BEGIN HEADER -->
    <div class="front-topbar">
        <div class="container">
            <div class="row">
              <div class="row">
                                  <div class="col-md-9 col-sm-9">
                                      <ul class="list-unstyle inline">
                                          <li><i class="fa fa-phone topbar-info-icon top-2"></i>Call us: <span>(+92) 321 6880801</span></li>
                                          <li class="sep"><span>|</span></li>
                                          <li><i class="fa fa-envelope-o topbar-info-icon top-2"></i>Email: <span>jahanxbkhan@hotmail.com</span></li>
                                      </ul>
                                  </div>
                <div class="col-md-3 col-sm-3 login-reg-links">
                    <ul class="list-unstyled inline">
                        <li><a href="page_login.html">Hello,<?php echo $userRow['email']; ?></a></li>
                        <li class="sep"><span>|</span></li>
                        <li><button type="button" class="btn red" placeholder="Logout" name="log-out"><a href="logout.php?logout=true"> <font color="white">Logout</font></a></button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END TOP BAR -->

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
</div>
    <!-- END HEADER -->
		<!-- BEGIN PAGE CONTAINER -->
		<div class="page-container">

        <!-- BEGIN BREADCRUMBS -->
        <div class="row breadcrumbs margin-bottom-40">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Personal Information</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="">Pages</a></li>
                        <li class="active">Home</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
      <!-- BEGIN CONTAINER -->
        <div class="container margin-bottom-40">
          <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 login-signup-page">
                <form method="post" name="form1">

                  <h2>Personal Information</h2>

									<div class="input-group margin-bottom-20">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="hidden" value= "<?php echo $stupid_id; ?>" name="u_fk_id">
								</div>


                  <div class="input-group margin-bottom-20">
                    	<span class="input-group-addon"><i class="fa fa-user"></i></span>
                  		<input type="text" class="form-control" name="FirstName" placeholder="First Name">
                  </div>

                  <div class="input-group margin-bottom-20">
                  		<span class="input-group-addon"><i class="fa fa-user"></i></span>
                  		<input type="text" class="form-control" name="LastName" placeholder="Last Name">
                  </div>
                   <div class="input-group margin-bottom-20">
                  	 <span class="label label-default">Date of Birth</span>
                  		<input type="date" class="form-control" name="Date_of_birth">
                  </div>
                  <div class="input-group margin-bottom-20">
                  		<span class="label label-default">Gender</span>

                  &emsp;
                  				 <input type="radio" name="Gender" value="male">Male</input>
                  &emsp;
                  				<input type="radio" name="Gender" value="female">Female</input>
                  			 </div>


                  			 <div class="form-group">
                  <span class="label label-default">Blood Group</span>
                  <select class="form-control" name="bloodGroup">
                  <option>-Select Blood Group-</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>

                  </select>
                  </div>


                                      <div class="row">
                                          <div class="col-md-12">
                                              <button type="submit" name="btn-submit" class="btn theme-btn pull-right">Next</button>
                                          </div>
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
