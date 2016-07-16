<?php
require_once("session.php");
require_once('class.user.php');
require_once('config1.php');


$auth_user = new USER();
$person = new USER();
$donorRecp= new USER();

$userID = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE userID=:userID");
$stmt->execute(array(":userID"=>$userID));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$stmt1 = $auth_user->runQuery("SELECT PersonID FROM person WHERE user_userID=:user_userID");
$stmt1->execute(array(":user_userID"=>$userID));
$userRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
$stupid_id=$userRow1['PersonID'];
$donorRecp->editProfile($stupid_id);
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
$quer3="SELECT DISTINCT CityName, CityID FROM city where Province_ProvinceID=$cat3  order by CityName";
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



 	<SCRIPT language=JavaScript>
 	function reload(form)
 	{
 	var val=form.country1.options[form.country1.options.selectedIndex].value;
 	self.location='edit.php?cat=' + val ;
 	}
 	function reload3(form)
 	{
 	var val=form.country1.options[form.country1.options.selectedIndex].value;
 	var val2=form.province1.options[form.province1.options.selectedIndex].value;
  // var val3=form.city1.options[form.city1.options.selectedIndex].value;
  // self.location='home.php?cat='+val + '&cat3='+ val2 +'&cat2=' +val3;
 	self.location='edit.php?cat=' + val + '&cat3=' + val2;
 	}
 	function reload2(form)
 	{
 		var val=form.country1.options[form.country1.options.selectedIndex].value;
 		var val2=form.province1.options[form.province1.options.selectedIndex].value;
 		var val3=form.city1.options[form.city1.options.selectedIndex].value;
 		self.location='edit.php?cat='+val + '&cat3='+ val2 + '&cat2=' +val3;
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
                            <li><a href="page_about.html">About Us</a></li>
                            <li><a href="page_services.html">Services</a></li>

                            <li><a href="page_faq.html">FAQ</a></li>
                            <li><a href="page_gallery.html">Gallery</a></li>
                            <li><a href="page_search_result.html">Fatimid Foundation</a></li>
                            <li><a href="page_careers.html">Benefits of Blood Donation</a></li>

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
                            <li><a href="page_careers.html">Careers</a></li>
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
                    <h1>Edit Information</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="">Pages</a></li>
                        <li class="active">Edit Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <div class="container">


        	<div class="row">

              <!-- edit form column -->
              <div class="col-md-9 personal-info">
                <div class="alert alert-info alert-dismissable">
                  <a class="panel-close close" data-dismiss="alert">×</a>
                  <i class="fa fa-coffee"></i>
                  This is an <strong>.alert</strong>. Use this to show important messages to the user.
                </div>
                <form class="form-horizontal" role="form">

                <h5>Update User</h5>
                <div class="form-group">
                  <label class="col-md-3 control-label">Email:</label>
                  <div class="col-md-8">
                    <input class="form-control" id="disabledInput" type="text" value="<?php echo $userRow['email']; ?>" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Password:</label>
                  <div class="col-md-8">
                    <input class="form-control" id="disabledInput" type="password" value="11111122333" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">Contact No.:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" value="11111122333">
                  </div>
                </div>
                  <hr>
                <h5>Update Personal Information</h5>

                  <div class="form-group">
                    <label class="col-lg-3 control-label">First name:</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" value="Jane">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Last name:</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" value="Bishop">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Gender:</label>
                    <div class="col-md-8">
                      Male
                      <input name="Gender" type="radio" value="male"></input>
                      Female
                      <input type="radio" name="Gender" value="female"> </input>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Blood Group:</label>
                    <div class="col-md-8">
                      <div class="ui-select">
                        <select id="user_time_zone" class="form-control" name="bloodGroup" placeholder="--Blood Group---">
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
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Date of Birth:</label>
                    <div class="col-md-8">
                      <input class="form-control" type="date" name="Date_of_birth">
                    </div>
                  </div>

                <hr>
                  <h5>Update Address</h5>
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
?>
</div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Optional:</label>
                    <div class="col-md-4">
                      <input class="form-control input-sm" type="text" value="City Area Name" />
                      <input class="form-control input-sm" type="text" value="Block No" />
                      <input class="form-control input-sm" type="text" value="Street No" />
                      <input class="form-control input-sm" type="text" value="House No" />
                    </div>
                  </div>
                  <hr>
                  <h5>Edit Donor Profile</h5>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Last Bleed Date:</label>
                    <div class="col-md-8">
                      <input class="form-control" type="date" value="11111122333">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Body Weight:</label>
                    <div class="col-md-8">
                  <input class="form-control" value="90" min="50" max="250" name="bodyWeight" placeholder="Select your Body Weight(Kg)" type="number">
                    </div>
                  </div>
                  <hr>
                  <h5>Edit Recipient Profile</h5>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Recieved Blood Date:</label>
                    <div class="col-md-8">
                      <input class="form-control" type="date" name="RecievedBloodDate">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Emergency:</label>
                    <div class="col-md-8">
                      <div class="ui-select">
                        <select id="user_time_zone" class="form-control" name="CurrentlyNeed">
                          <option>-Currently Need-</option>
                  <option value="YES">YES</option>
                  <option value="NO">NO</option>


                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input type="button" class="btn btn-primary" value="Save Changes">
                      <span></span>
                      <input type="reset" class="btn btn-default" value="Cancel">
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
        <hr>
