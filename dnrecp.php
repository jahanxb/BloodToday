<?php
require_once("session.php");
require_once("class.user.php");

$auth_user = new USER();
$person = new USER();
$donorRecp= new USER();
$user = new USER();
if($user->getFlag()==0){
	$user->redirect('verify.php');
}

$userID = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE userID=:userID");
$stmt->execute(array(":userID"=>$userID));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$stmt1 = $auth_user->runQuery("SELECT PersonID FROM person WHERE user_userID=:user_userID");
$stmt1->execute(array(":user_userID"=>$userID));
$userRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
$stupid_id=$userRow1['PersonID'];
$donorRecp->checkDonorRecp($stupid_id);
if(isset($_POST['btn-all'])){

	$person->redirect('index.php');
}

if (isset($_POST['btn-donate'])) {
$lastbleedDate= strip_tags($_POST['lastbleedDate']);
$bodyWeight= strip_tags($_POST['bodyWeight']);
$donatedHospital= strip_tags($_POST['donatedHospital']);
$TestDate=strip_tags($_POST['TestDate']);
$BloodTestTaken=strip_tags($_POST['BloodTestTaken']);
$TestCentreOrHospital=strip_tags($_POST['TestCentreOrHospital']);
$person_PersonID= strip_tags($_POST['u_pk_id']);

	try {
		if ($donorRecp->donorRecp($lastbleedDate,$bodyWeight,$donatedHospital,$TestDate,$BloodTestTaken,$TestCentreOrHospital,$person_PersonID)){
				$donorRecp->redirect('index.php');
		}

	}
	catch (PDOException $e){
		echo $e->getMessage();
	}
}
else if (isset($_POST['btn-recp'])){
	$RecievedBloodDate= strip_tags($_POST['lastRecieved']);
	$ReasonCauseDisease= strip_tags($_POST['ReasonDisease']);
	$CurrentlyNeed= strip_tags($_POST['CurrentlyNeed']);
	$CentreOrHospital=strip_tags($_POST['hospital']);
	$RecievedBloodQuantity=strip_tags($_POST['bloodQuantity']);
	$RefferedByWhom=strip_tags($_POST['bloodTransf']);
	$person_PersonID= strip_tags($_POST['u_pk_id']);
try {
			if($donorRecp->RecpREG($RecievedBloodDate,$ReasonCauseDisease,$CurrentlyNeed,$CentreOrHospital,$RecievedBloodQuantity,$RefferedByWhom,$person_PersonID))
			$donorRecp->redirect('index.php');
}
catch(PDOException $e){
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
                        <li><button type="button" class="btn red" placeholder="Logout" name="log-out"> <a href="logout.php?logout=true"><font color="white">Logout</a></font></button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END TOP BAR -->


</div>
    <!-- END HEADER -->
    <div class="container min-hight">
  			<!-- BEGIN ABOUT INFO -->
  			<div class="row margin-bottom-30">
  				<!-- BEGIN INFO BLOCK -->
  				<div class="col-md-7 space-mobile">
  					<h2>Select Your Role</h2>
  					<p>Be a Volunteer in our community.Donate Blood or Ask for Blood Donation</p>

  					<!-- BEGIN LISTS -->
  					<div class="row front-lists-v1">
  						<div class="col-md-6">
  							<ul class="list-unstyled margin-bottom-20">
  								<li><i class="fa fa-check"></i> Fill a Form Un-(Tick the Other)</li>
  								<li><i class="fa fa-check"></i> Or be<strong>HUMAN</strong> Fill Them & Click on Green</li>
									<li><i class="fa fa-check"></i>it won't Hurt , I promise</li>


  						</div>



</div></div>

	<script>
		$(function(){
			var checkbox1 = $(".checkbox1");
			var box1 = $(".box1");
			checkbox1.change(function(){
				box1.toggleClass("minimize");

			});

			var checkbox2 = $(".checkbox2");
			var box2 = $(".box2");
			checkbox2.change(function(){
				box2.toggleClass("minimize");
			});
		});

	</script>
    <!-- BEGIN CONTAINER -->

    <div class="container min-hight">
        <!-- BEGIN ABOUT INFO -->
        <div class="row margin-bottom-30">
          <!-- BEGIN INFO BLOCK -->
          <div class="row">

        <div class="col-md-6 col-sm-4 login-signup-page">


					<form  method="post" name="donor">

				<h2>Donor Profile</h2>
				<div class="checker">
					<span class="checked">
<input type="hidden" value= "<?php echo $stupid_id; ?>" name="u_pk_id">
						 <input type="checkbox" class="checkbox1" name="checkdonor">
					</span>
				</div>


				<div class="box1">

					<div class="input-group margin-bottom-20">
						 <span class="input-group-addon"><i class="fa fa-user"></i></span>
						 <span class="label label-default">Last Bleed Date</span>
						<input type="date" class="form-control" name="lastbleedDate" placeholder="Last Bleed Date">
					</div>
					<div class="input-group margin-bottom-20">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						  <span class="label label-default">Select your Body Weight (in Kg).</span>
						<input type="number" class="form-control" min="50" max="250" name="bodyWeight" placeholder="Select your Body Weight">
					</div>
					 <div class="input-group margin-bottom-20">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" name="donatedHospital" placeholder="Previously Donated Blood to Whom/Hospital/Centre">
					</div>
					<h6>Optional </h6>
					<div class="input-group margin-bottom-20">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>

							<div class="form-group">
							<span class="label label-default">Have You Taken any Blood Test</span>
							<select class="form-control" name="BloodTestTaken">
							<option>-Select One-</option>
							<option value="YES">Yes</option>
							<option value="NO">No</option>


							</select>
							</div>
					</div>
					<div class="input-group margin-bottom-20">
						 <span class="input-group-addon"><i class="fa fa-user"></i></span>
						 <span class="label label-default">Test Date</span>
						<input type="date" class="form-control" name="TestDate" placeholder="Last Taken Blood Test Date">
					</div>
					<div class="input-group margin-bottom-20">
					 <span class="input-group-addon"><i class="fa fa-user"></i></span>
					 <input type="text" class="form-control" name="TestCentreOrHospital" placeholder="Blood Test Approved by Whom/Hospital/Centre">
					</div>
					<div class="input-group margin-bottom-20">
					 <span class="input-group-addon"><i class="fa fa-user"></i></span>
					 <input type="file" class="form-control" name="uploadBloodReport" placeholder="Upload Your Blood Report in (jpeg,docx,pdf) ">
					</div>
					 <div class="row">
						<div class="col-md-12">
							<button type="submit" name="btn-donate" class="btn theme-btn pull-right">let's Donate</button>
						</div>
					</div>
&thinsp;

				</div>


				</form>
			</div>

		<div class="col-md-6 col-sm-4 login-signup-page">
           <form method="post" name="recp">



                <h2>Recipient Profile</h2>
                <div class="checker">
                  <span class="checked">
										<input type="hidden" value= "<?php echo $stupid_id; ?>" name="u_pk_id">

                       <input type="checkbox" class="checkbox2">
              </span>
                     </div>


			<div class="box2">

						<div class="input-group margin-bottom-20">
                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                         <span class="label label-default">Recieved Blood Date</span>
                    <input type="date" class="form-control" name="lastRecieved" placeholder="Recieved Blood Date">
                </div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

										<div class="form-group">
										<span class="label label-default">Disease/Reason for blood </span>
										<select class="form-control" name="ReasonDisease">
										<option>-Select One-</option>
										<option value="Thelesimia">Thelesimia</option>
										<option value="accident">Accident</option>
										<option value="NotSpecific">Other (Not Specific)</option>

										</select>
										</div>
								</div>
								<div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

										<div class="form-group">
										<span class="label label-default">Are You IN Emergency</span>
										<select class="form-control" name="CurrentlyNeed">
										<option>-Select One-</option>
										<option value="YES">Yes</option>
										<option value="NO">No</option>


										</select>
										</div>
								</div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="hospital" placeholder="Hospital Name in which, You or the recipient Admitted in.">
                </div>
								<h6> Optional </h6>
                 <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

										<div class="form-group">

						 <span class="label label-default">Blood Quantity (Select Range mg/L)</span>
						 <select class="form-control" name="bloodQuantity">
						 <option>-Select Blood Range-</option>
						 <option value="300-350(mg/L)">300 to 350 mg/L</option>
						 <option value="351-400(mg/L)">351-400(mg/L)</option>
						 <option value="401-450(mg/L)">401-450(mg/L)</option>

						 </select>
					 </div> </div>
						 <div class="input-group margin-bottom-20">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>

						 <div class="form-group">
			<span class="label label-default">Blood Transfusion Specs</span>
			<select class="form-control" name="bloodTransf">
			<option>-Select One-</option>
			<option value="Plattelets">plattelets</option>
			<option value="Whitecells">whitecells</option>
			<option value="Others">others</option>
			<option value="General">General</option>

			</select>
		</div> </div>

<br>
&thinsp;&thinsp;&thinsp;



                 <div class="row">
                    <div class="col-md-12">
                        <button type="submit" name="btn-recp" class="btn theme-btn pull-right">Don't Worry, We 're here</button>
                    </div>
                </div>
								&thinsp;
</div>
</div>
</div>
<!-- END LISTS -->
</div>
<!-- END INFO BLOCK -->
<br>
<div class="container min-hight">
    <!-- BEGIN ABOUT INFO -->
    <div class="row margin-bottom-30">
      <!-- BEGIN INFO BLOCK -->
      <div class="btn-toolbar">
        <div class="btn-group btn-group-lg btn-group-solid margin-bottom-10">
            <button type="button" class="btn green" name="btn-all"> SkipThis </button>
        </div>

  </div>

</form>












    <?php
//  include_once('include/footer.php');

    ?>
    <script>

    function chkboxClick(chkbox) {
        chkbox.nextSibling.nextSibling.disabled = !chkbox.checked;

    }
    </script>



        <!-- Load javascripts at bottom, this will reduce page load time -->
        <!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <![endif]-->
        <script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/plugins/back-to-top.js"></script>

        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
        <script type="text/javascript" src="assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="assets/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
        <script type="text/javascript" src="assets/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script type="text/javascript" src="assets/plugins/bxslider/jquery.bxslider.min.js"></script>
        <script src="assets/scripts/app.js"></script>
        <script src="assets/scripts/index.js"></script>
        <!-- Latest compiled and minified JavaScript -->
       <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            jQuery(document).ready(function() {
                App.init();
                App.initBxSlider();
                Index.initRevolutionSlider();
            });
        </script>
        <!-- END PAGE LEVEL JAVASCRIPTS -->
<?php
//include_once('include/footer.php');
 ?>
    </body>
    <!-- END BODY -->
            </html>
