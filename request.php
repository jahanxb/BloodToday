<?php
require_once('phpmailer/PHPMailerAutoload.php');

//error_reporting(0);
require_once("session.php");

require_once("class.user.php");
require_once("config.php");

$auth_user = new USER();
$person = new USER();
$address= new USER();
$user = new USER();
if($user->getFlag()==0){
$user->redirect('verify.php');
}
$userID = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE userID=:userID");
$stmt->execute(array(":userID"=>$userID));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
$stupid_id=$userRow['userID'];
$contactedBy=$userRow['email'];

$stmt1 = $auth_user->runQuery("SELECT PersonID FROM person WHERE user_userID=:user_userID");
$stmt1->execute(array(":user_userID"=>$userID));
$userRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
$stupid_id_P=$userRow1['PersonID'];
//echo $_GET['var'];
$contactedTo=$_GET['var'];

try {

if(isset($_POST['contact-btn-request'])){
  $contactedBy=strip_tags($_POST['contactedBy']);
  $contactedTo_1=strip_tags($_POST['contactedTo']);
  $DonorFlag=strip_tags($_POST['DonorFlag']);
  $DateTime=strip_tags($_POST['date'].' '.$_POST['time']);
//  $Date=strip_tags($_POST['date']);
//  $Time=strip_tags($_POST['time']);
  if($person->history_1($contactedBy,$contactedTo_1,$DonorFlag,$DateTime)) {
      //	$person->redirect('history.php');
        sendMail($contactedTo,$contactedBy,$DateTime);
  }



        }
          else {
        //  echo "Error";

                        }

} catch(PDOException $e) {  echo $e->getMessage();  }



 ?>
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
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
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
 <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
 <script>
 $(document).ready(function() {
 	$('#example').DataTable();
 } );
 </script>

<body>

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
                      <li><button type="button" class="btn red" placeholder="Logout" name="log-out"> <a href="logout.php?logout=true"><font color="white">Logout</a></font></button></li>
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
                        <li><a href="#">Download Mobile App</a></li>
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
                  <h1>Send Request To Donor</h1>
              </div>
              <div class="col-md-8 col-sm-8">
                  <ul class="pull-right breadcrumb">
                      <li><a href="mainlogo.php">Home</a></li>
                      <li><a href="">Pages</a></li>
                      <li class="active">Request</li>
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
              <input type='hidden' name='contactedTo'value="<?php echo $_GET['var']; ?>"></input>
              <input type='hidden' name='contactedBy' value="<?php echo $userRow['email']; ?>"></input>
              <input type='hidden' name='DonorFlag' value='1'></input>


              <?php
                if(isset($error)){

                foreach($error as $error)
                {
                  //fucking code of that indian dude
               ?>

               <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
               </div>
               <?php
               }
               }
                ?>
              <h2>Request Form</h2>

              <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <span class="label label-default">From</span>

                <input type="text" class="form-control" name="contactedBy" placeholder="E-mail" value="<?php echo $userRow['email']; ?>"  readonly="readonly"/>
                <div class="input-group margin-bottom-20">
                  <span class="label label-default">Submit Date and Time</span>
                   <input type="date" class="form-control"  name="date"></input>
                   <input type="time" class="form-control" name="time"></input>
                                 </div>
            </div>

<span class="label label-default">To:</span>
            <div class="input-group margin-bottom-20">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="text" class="form-control"  name="contactedTo" placeholder="Enter Email" value="<?php echo $contactedTo; ?>" readonly="readonly" />
                </div>


                <?php
  //  echo "The time is " . date("yy:mm:dd:h:i:sa");
  ?>







                            <div class="row">
                              <div class="col-md-12">
                        <input type="submit" class="btn btn-signup" value="Send Request" name="contact-btn-request"/>
                                      </div>
                                  </div>








                                </form>
        </div>
      </div>
    </div>
    <!-- END CONTAINER -->





<!---
  <form method="post">
    <input type="text" value="<?php //echo $userRow['email']; ?>" name="contactedBy" readonly="readonly"/>
    <input type="email" placeholder="Enter Email" name="email"/>
    <input type="submit" value="Fire complaint" name="btn-submit"/>
  </form>
!-->
</div>
  <!-- END PAGE CONTAINER -->
  <?php
  function sendMail($email, $code,$DateTime){
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

  	$mail->addAddress($email, "Hi,It's Time to Donate");

  	$mail->isHTML(true);

  	$mail->Subject = "Let's Donate Blood";
  	$mail->Body = "Respected Person, <br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; This Person :'.
    $code.' Contacted  you to Donate Blood at datetime'.$DateTime.
    '  , This auto-generated email is sent to your email: <b>"."<a>bloodtodayorg@gmail.com</a>"."</b>. <hr>
  	Thanks for using our services.";
  	$mail->AltBody = " if this isn't your email:. "."<a>bloodtodayorg@gmail.com</a>"."Let us Know <br> Thanks for using our services.";

  	if(!$mail->send())
  	{
  	echo "Mailer Error: " . $mail->ErrorInfo;
  	}
  	else
  	{
      echo "<div class='alert alert-success'>
          <i class='glyphicon glyphicon-success-sign'></i> &nbsp;"
      ."Message has been sent successfully"."</div>";
  	}

  }


  ?>




<?php
include_once('include/footer.php');
?>
