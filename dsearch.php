<?php
error_reporting(0);

//session_start();
//include_once('include/header.php');
	require_once("session.php");
	require_once("class.user.php");
	require_once('config1.php');

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

 	<SCRIPT language=JavaScript>
 	function reload(form)
 	{
 	var val=form.country1.options[form.country1.options.selectedIndex].value;
 	self.location='dsearch.php?cat=' + val ;
 	}
 	function reload3(form)
 	{
 	var val=form.country1.options[form.country1.options.selectedIndex].value;
 	var val2=form.province1.options[form.province1.options.selectedIndex].value;
  // var val3=form.city1.options[form.city1.options.selectedIndex].value;
  // self.location='home.php?cat='+val + '&cat3='+ val2 +'&cat2=' +val3;
 	self.location='dsearch.php?cat=' + val + '&cat3=' + val2;
 	}
 	function reload2(form)
 	{
 		var val=form.country1.options[form.country1.options.selectedIndex].value;
 		var val2=form.province1.options[form.province1.options.selectedIndex].value;
 		var val3=form.city1.options[form.city1.options.selectedIndex].value;
 		self.location='dsearch.php?cat='+val + '&cat3='+ val2 + '&cat2=' +val3;
 	}


 	</script>
  <script language="JavaScript">
  $(document).ready(function() {
    $('#example').DataTable();
  } );
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
                    <h1>Search for Recipients</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="">Pages</a></li>
                        <li class="active">Search</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
      <!-- BEGIN CONTAINER -->
			<form method="post" name="f1">
        <div class="container margin-bottom-60">

          <div class="row">
            <div class="col-md-18  col-sm-12 ">

        <h2>Search</h2>

       <table class="table table-striped table-bordered" cellspacing="0" width="50%">
         <thead>
           <tr>
             <th>
							 <div class="form-group">

							 <?php
							 //////////        Starting of first drop downlist /////////
							 echo "<select class='form-control' name='country1' onchange=\"reload(this.form)\"><option value=''>Select Country</option>";
							 foreach ($dbo->query($quer2) as $noticia2) {
							 if($noticia2['CountryID']==@$cat){echo "<option selected value='$noticia2[CountryID]'>$noticia2[CountryName]</option>"."<BR>";}
							 else{echo  "<option value='$noticia2[CountryID]'>$noticia2[CountryName]</option>";}
							 }
							 echo "</select>";
							 ?>
							 </div>
             </th>
             <th>
							 <div class="form-group">

			 <?php										//////////        Starting of second drop downlist /////////
			 echo "<select class='form-control' name='province1' onchange=\"reload3(this.form)\"><option value=''>Select Province</option>";
			 	foreach ($dbo->query($quer) as $noticia) {
			 if($noticia['ProvinceID']==@$cat3){echo "<option selected value='$noticia[ProvinceID]'>$noticia[ProvinceName]</option>"."<BR>";}
			 else{echo  "<option value='$noticia[ProvinceID]'>$noticia[ProvinceName]</option>";}
			 }
			 					echo "</select>";
			 					//////////////////  This will end the second drop down list ///////////
			 ?>
											</div>
                  </th>
             <th>
							 <div class="form-group">

<?php


//////////        Starting of third drop downlist        onchange=\"reload2(this.form)\" /////////
echo "<select class='form-control' name='city1'   onchange=\"reload2(this.form)\"><option value=''>Select City</option>";
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
                    </th>
             <th>
							 <div class="form-group">

							    <select class="form-control" name="emergency">  <option> Respond to  Emergencies </option>
											<option value="YES">YES</option>
											<option value="NO">NO</option>

                    </select>
									</div>
                  </th>
     					<th>
								<div class="form-group">

			      <button class="btn btn-default" name="btn-search"> <i class="glyphicon glyphicon-search">&thinsp;&thinsp;&thinsp;</i> </button>
					</select>
				</div>
				</th>
           </tr>
         </thead>
                </table>
      </div>
      </div>
      </div>
    </div>
</form>

       <div class="container">
         <h2>Help Them</h2>

        <table class="table table-striped table-bordered" id="example" cellspacing="0" width="70%">
          <thead>
            <tr>
              <th>First Name</th>
							<th> Last Name</th>

							<th>Blood Group</th>
              <th>Emergency</th>
              <th>City
								& Address</th>

              <th> More Info </th>
							<th>Complaint</th>
							<th>Send Invitation</th>
						</tr>
          </thead>
          <tbody>
						<?php


						if(isset($_POST['btn-search']))
						{


								try
								{
									$country= strip_tags($_POST['country1']);
									$province= strip_tags($_POST['province1']);
									$city= strip_tags($_POST['city1']);
									$emergency= strip_tags($_POST['emergency']);



							$userRow = $address->getPersonSearchDetailForRecipient($country, $province, $city, $emergency);
								foreach (	$userRow as $obj) {
									echo "<tr>";
									echo "<td>".$obj['FirstName']."</td>";
									echo "<td>".$obj['LastName']."</td>";
									echo "<td>".$obj['bloodGroup']."</td>";
                  echo "<td>".$obj['CurrentlyNeed']."</td>";
									echo "<td>".$obj['CityName']."&thinsp;"."|".$obj['CityAreaName']."</td>";

                  echo "<td> <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#myModal'>More Info</button>

                  <div class='modal fade' id='myModal' role='dialog'>
                     <div class='modal-dialog modal-md'>
                       <div class='modal-content'>
                         <div class='modal-header'>
                           <button type='button' class='close' data-dismiss='modal'>&times;</button>
                           <h4 class='modal-title'>Personal Information </h4>
                         </div>
                         <div class='modal-body'>".
                         " <ul class='list-group'> "
                  ." <li class='list-group-item active'>" ."<h5><span class='label label-default'><b>Name:</b></span>". " ".$obj['FirstName']."&thinsp;" .$obj['LastName']."</h5></li> ".
                  " <li class='list-group-item'>"	. "<h5><span class='label label-default'><b>Email:</b></span>"." ".$obj['email']."</h5></li> ".
                  " <li class='list-group-item'>". "<h5><span class='label label-default'><b>Date of Birth:</b></span>". " ".$obj['Date_of_birth']."</h5></li>".
                    " <li class='list-group-item'>".			 "<h5><span class='label label-default'><b>Blood Group:</b></span>". " ".$obj['bloodGroup']."</h5></li>".
          " <li class='list-group-item'>".								 "<h5><span class='label label-default'><b>Gender:</b></span>". " ".$obj['gender']."</h5></li>".
          " <li class='list-group-item danger'>".								 "<h5><span class='label label-default'><b>Emergency:</b></span>". " ".$obj['CurrentlyNeed']."</h5></li>".

                " <li class='list-group-item'>".									 "<h5><span class='label label-default'><b>Previously Recv.Blood Date:</b></span>". " ".$obj['RecievedBloodDate']."</h5></li>".

        " <li class='list-group-item'>".									 "<h5><span class='label label-default'><b>Admitted In :</b></span>". " ".$obj['CentreOrHospital']."</h5></li>".
        " <li class='list-group-item disabled'>".								 "<h5><span class='label label-default'><b>Contact No:</b></span>". " ".$obj['phoneNo']."</h5></li>".

          " <li class='list-group-item'>".								 "<h5><span class='label label-default'><b>Reason/Disease</b></span>". " ".$obj['ReasonCauseDisease']."</h5></li>".
            " <li class='list-group-item'>".								 "<h5><span class='label label-default'><b>Required Blood Quantity</b></span>". " ".$obj['RecievedBloodQuantity']."</h5></li>".
        " <li class='list-group-item list-group-item-info'>".									 "<h5><span class='label label-default'><b>Address:</b></span>". " "
                           .$obj['CountryName']."&thinsp; ," .$obj['ProvinceName']."&thinsp; ,"
                           .$obj['CityName']."&thinsp; ,"
                            .$obj['CityAreaName']."&thinsp; ," .$obj['BlockNo']."&thinsp; ,"
                             .$obj['StreetNo']."&thinsp; ," .$obj['HouseNo']."</h5></li>".
        " <li class='list-group-item'>".										 "<h5><span class='label label-default'><b>Previously Known Location:</b></span>"."&thinsp;".
                             "<a href='currentloc.php'>Visit Here!!</a> "."</h5>"
                          ."</ul>"
                         ."</div>
                         <div class='modal-footer'>
                           <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                         </div>
                       </div>
                     </div>
                   </div>

 </td>";
 echo "<td>"."<a href='dcomplaint.php?var=".$obj['email']."&var1=".$obj['RecipientID']."&var2=".$obj['PersonID']."'><input type='button' name='contact-btn-complaint' value='Complaint'class='btn btn-warning'>"."</input> </a></td>";
 echo "<td>"."<a href='invite.php?var=".$obj['email']."'><input type='button' name='contact-btn-request' value='Send Invite'class='btn btn-primary'>"."</input></a></td>";


									echo "</tr>";

								}

					//  			$stmt = $user->runQuery("SELECT userID,PersonID FROM user,person");
						//			$stmt->execute(array(':email'=>$email, ':phoneNo'=>$phoneNo));
						//			$row=$stmt->fetch(PDO::FETCH_ASSOC);

					//  				if($person->registerPerson($FirstName,$LastName,$Date_of_birth,$Gender,$bloodGroup,$user_userID)){
						//				$person->redirect('home.php');
								//		}
									}

								catch(PDOException $e)
								{
									echo $e->getMessage();
								}
					}
					else{


/*
									$userRow = $address->getPersonDetail();
								foreach (	$userRow as $obj) {
									echo "<tr>";
									echo "<td>".$obj['FirstName']."</td>";
									echo "<td>".$obj['LastName']."</td>";
									echo "<td>".$obj['bloodGroup']."</td>";
									echo "<td>".$obj['CityName']."&thinsp;"."|".$obj['CityAreaName']."</td>";
								//	echo "<td>"."</td>";
									echo "<td> Click Here For More Info </td>";
									echo "</tr>";

								}
								*/
								}

						?>


          </tbody>
        </table>
      </div>
    </div>



<?php
//include_once('include/footer.php');
?>
