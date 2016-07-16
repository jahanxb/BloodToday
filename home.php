<?php
error_reporting(0);
//include_once('include/header.php');
	require_once("session.php");
require_once ("config1.php");
	require_once("class.user.php");

	$auth_user = new USER();
	$address= new USER();

	$userID = $_SESSION['user_session'];

	$user = new USER();
		if($user->getFlag()==0){
			$user->redirect('verify.php');
		}
	$stmt = $auth_user->runQuery("SELECT * FROM user WHERE userID=:userID");
	$stmt->execute(array(":userID"=>$userID));

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
///
$stmt1 = $auth_user->runQuery("SELECT PersonID FROM person WHERE user_userID=:user_userID");
$stmt1->execute(array(":user_userID"=>$userID));
$userRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
$stupid_id=$userRow1['PersonID'];
$address->checkAddress($stupid_id);


/* Now for Person Session
$personID= $_SESSION['user_session'];
$stmt1= $auth_user->runQuery("SELECT * FROM person,user WHERE user.userID=:person.user_userID");
$stmt1-> execute(array(":personID"=>$personID));
$userRowPerson=$stmt1->fetch(PDO::FETCH_ASSOC);
*/ //end Person
///////// Getting the data from Mysql table for first list box//////////
$quer2="SELECT DISTINCT CountryName,CountryID FROM country order by CountryName";
///////////// End of query for first list box////////////

$cat=$_GET['cat']; // This line is added to take care if your global variable is off
if(isset($cat) and strlen($cat) > 0){
$quer="SELECT DISTINCT ProvinceName,ProvinceID FROM province where Country_CountryID=$cat order by ProvinceName";
}
else
{
	$quer="SELECT DISTINCT ProvinceName,ProvinceID FROM province order by province";
 }

/////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3/////
$cat3=$_GET['cat3']; // This line is added to take care if your global variable is off
$cat2=$_GET['cat2'];
if (isset($cat3) and strlen ($cat3)) {
//if(( isset($cat3) and strlen($cat3)) or ( isset($cat2) and strlen($cat2) ) > 0){
//	$quer3="SELECT DISTINCT CityName FROM city where Province_ProvinceID=$cat3 order by CityName";
//$quer3="SELECT DISTINCT CityName FROM city where Province_ProvinceID=$cat3 AND CityID=$cat2 order by CityName";

//if(isset($cat2)and strlen($cat2) > 0){
$quer3="SELECT DISTINCT CityName, CityID FROM city where Province_ProvinceID=$cat3  order by CityName";
//}

}

//else
//{$quer3="SELECT DISTINCT CityName FROM city order by CityName"; }
////////// end of query for third subcategory drop down list box ///////////////////////////
/////// for second drop down list we will check if category is selected else we will display all the subcategory/////

////////// end of query for second subcategory drop down list box ///////////////////////////


//echo "<form method=post name=f1'>";

//echo "<input type=submit value='Submit the form data'></form>";
if(isset($_POST['btn-submit']))
{

$country= strip_tags($_POST['country1']);
$province= strip_tags($_POST['province1']);
$city= strip_tags($_POST['city1']);
$cityAreaName= strip_tags($_POST['cityAreaName']);
$blockName= strip_tags($_POST['blockName']);
$streetno=strip_tags($_POST['streetno']);
$houseNo=strip_tags($_POST['houseNo']);
$PersonID=strip_tags($_POST['u_pk_id']);
//$temp = "Select personID from Person where user_userID = " + $userID;
/*
$PersonID ="";
foreach ($conn->query($temp) as $x)
{
  	$PersonID = $x['PersonID'];

}
echo $PersonID;
*/
//$user_userID=strip_tags($_POST($userRow['userID']));


		try
		{
//  			$stmt = $user->runQuery("SELECT userID,PersonID FROM user,person");
//			$stmt->execute(array(':email'=>$email, ':phoneNo'=>$phoneNo));
//			$row=$stmt->fetch(PDO::FETCH_ASSOC);

				if($address->addAddress($country,$province,$city,$cityAreaName,$blockName,$streetno,$houseNo, $PersonID)){
				$address->redirect('dnrecp.php');
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


	 <SCRIPT language=JavaScript>
	 function reload(form)
	 {
	 var val=form.country1.options[form.country1.options.selectedIndex].value;
	 self.location='home.php?cat=' + val ;
	 }
	 function reload3(form)
	 {
	 var val=form.country1.options[form.country1.options.selectedIndex].value;
	 var val2=form.province1.options[form.province1.options.selectedIndex].value;
	// var val3=form.city1.options[form.city1.options.selectedIndex].value;
	// self.location='home.php?cat='+val + '&cat3='+ val2 +'&cat2=' +val3;
	 self.location='home.php?cat=' + val + '&cat3=' + val2;
	 }
	 function reload2(form)
	 {
		 var val=form.country1.options[form.country1.options.selectedIndex].value;
		 var val2=form.province1.options[form.province1.options.selectedIndex].value;
		 var val3=form.city1.options[form.city1.options.selectedIndex].value;
		 self.location='home.php?cat='+val + '&cat3='+ val2 + '&cat2=' +val3;
	 }


	 </script>



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

                            <li><a href="page_contacts.html">Contact</a></li>
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
                    <h1>Address Information</h1>
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

							  <form method="post" name="f1">


										<h2>Address Info</h2>
<input type="hidden" value= "<?php echo $stupid_id; ?>" name="u_pk_id">
										<div class="form-group">
										<span class="label label-default" >Country</span>
<?php
//////////        Starting of first drop downlist /////////
echo "<select class='form-control' name='country1' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
foreach ($dbo->query($quer2) as $noticia2) {
if($noticia2['CountryID']==@$cat){echo "<option selected value='$noticia2[CountryID]'>$noticia2[CountryName]</option>"."<BR>";}
else{echo  "<option value='$noticia2[CountryID]'>$noticia2[CountryName]</option>";}
}
echo "</select>";
//////////////////  This will end the first drop down list ///////////

?>
										</div>



										<div class="form-group">
										<span class="label label-default" >Province</span>

<?php										//////////        Starting of second drop downlist /////////
				echo "<select class='form-control' name='province1' onchange=\"reload3(this.form)\"><option value=''>Select one</option>";
						foreach ($dbo->query($quer) as $noticia) {
		if($noticia['ProvinceID']==@$cat3){echo "<option selected value='$noticia[ProvinceID]'>$noticia[ProvinceName]</option>"."<BR>";}
	else{echo  "<option value='$noticia[ProvinceID]'>$noticia[ProvinceName]</option>";}
					}
										echo "</select>";
										//////////////////  This will end the second drop down list ///////////
?>
										</div>



										<div class="form-group">
									 <span class="label label-default" >City</span>
<?php


//////////        Starting of third drop downlist        onchange=\"reload2(this.form)\" /////////
echo "<select class='form-control' name='city1'   onchange=\"reload2(this.form)\"><option value=''>Select one</option>";
foreach ($dbo->query($quer3) as $noticia3) {
if ($noticia3['CityID']==@$cat2){
echo  "<option Selected value='$noticia3[CityID]'>$noticia3[CityName]</option>"."";
}
else { echo "<option value='$noticia3[CityID]'>$noticia3[CityName]</option>"; }
}
echo "</select>";
//////////////////  This will end the third drop down list ///////////

 ?>

									 </div>





										<h6>Optional</h6>
										<div class="input-group margin-bottom-20">
											 <span class="input-group-addon"><i class="fa fa-user"></i></span>
											 <input type="text" class="form-control" name="cityAreaName" placeholder="Enter City Area">
										</div>
										<div class="input-group margin-bottom-20">
											 <span class="input-group-addon"><i class="fa fa-user"></i></span>
											 <input type="text" class="form-control" name="blockName" placeholder="Enter Block Name">
										</div>

										<div class="input-group margin-bottom-20">
											 <span class="input-group-addon"><i class="fa fa-user"></i></span>
											 <input type="text" class="form-control" name="streetno" placeholder="Street Name">
										</div>
										<div class="input-group margin-bottom-20">
											 <span class="input-group-addon"><i class="fa fa-user"></i></span>
											 <input type="text" class="form-control" name="houseNo" placeholder="House No.">
										</div>

<hr>
										<div class="row">
												<div class="col-md-12">
														<button type="submit" name="btn-submit" class="btn theme-btn pull-right">Submit</button>
												</div>
										</div>

                                    </form>
            </div>
          </div>
								</div>
				</div>
        <!-- END CONTAINER -->

  </div>
    <!-- END PAGE CONTAINER -->



<?php
include_once('include/footer.php');
?>
