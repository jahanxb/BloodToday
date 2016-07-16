<?php
//error_reporting(0);
//require_once('include/header.php');
require_once("session.php");
require_once("class.user.php");
$auth_user = new USER();
$userID = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE userID=:userID");
$stmt->execute(array(":userID"=>$userID));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
$stupid_id=$userRow['userID'];

$user = new USER();
if($user->getFlag()==0){
  $user->redirect('verify.php');
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
                  <h1>Current Location</h1>
              </div>
              <div class="col-md-8 col-sm-8">
                  <ul class="pull-right breadcrumb">
                      <li><a href="index.html">Home</a></li>
                      <li><a href="">Pages</a></li>
                      <li class="active">Current location</li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- END BREADCRUMBS -->

     <div>
    <span class="label label-default" id="startLat">
    </span>

   <span class="label label-default" id="startLon">
    </span>
</div>


<script>

    if (navigator.geolocation) {
  console.log('Geolocation is supported!');
}
else {
  console.log('Geolocation is not supported for this Browser/OS version yet.');
}


window.onload = function() {

var startPos;
  var geoSuccess = function(position) {
    startPos = position;
    document.getElementById('startLat').innerHTML = startPos.coords.latitude;
    document.getElementById('startLon').innerHTML = startPos.coords.longitude;
  };
  var geoError = function(error) {
    console.log('Error occurred. Error code: ' + error.code);
    // error.code can be:
    //   0: unknown error
    //   1: permission denied
    //   2: position unavailable (error response from location provider)
    //   3: timed out
  };
  navigator.geolocation.getCurrentPosition(geoSuccess, geoError);

};
</script>


    <script>
    /*
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var origin_place_id = null;
        var destination_place_id = null;
        var travel_mode = google.maps.TravelMode.WALKING;
        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeControl: false,
          center: {lat: 30.1761044, lng: 71.4592143},
          zoom: 13
        });
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        directionsDisplay.setMap(map);

        var origin_input = document.getElementById('origin-input');
        var destination_input = document.getElementById('destination-input');
        var modes = document.getElementById('mode-selector');

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin_input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(destination_input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(modes);

        var origin_autocomplete = new google.maps.places.Autocomplete(origin_input);
        origin_autocomplete.bindTo('bounds', map);
        var destination_autocomplete =
            new google.maps.places.Autocomplete(destination_input);
        destination_autocomplete.bindTo('bounds', map);

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, mode) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            travel_mode = mode;
          });
        }
        setupClickListener('changemode-walking', google.maps.TravelMode.WALKING);
        setupClickListener('changemode-transit', google.maps.TravelMode.TRANSIT);
        setupClickListener('changemode-driving', google.maps.TravelMode.DRIVING);

        function expandViewportToFitPlace(map, place) {
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
          }
        }

        origin_autocomplete.addListener('place_changed', function() {
          var place = origin_autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }
          expandViewportToFitPlace(map, place);

          // If the place has a geometry, store its place ID and route if we have
          // the other place ID
          origin_place_id = place.place_id;
          route(origin_place_id, destination_place_id, travel_mode,
                directionsService, directionsDisplay);
        });

        destination_autocomplete.addListener('place_changed', function() {
          var place = destination_autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }
          expandViewportToFitPlace(map, place);

          // If the place has a geometry, store its place ID and route if we have
          // the other place ID
          destination_place_id = place.place_id;
          route(origin_place_id, destination_place_id, travel_mode,
                directionsService, directionsDisplay);
        });

        function route(origin_place_id, destination_place_id, travel_mode,
                       directionsService, directionsDisplay) {
          if (!origin_place_id || !destination_place_id) {
            return;
          }
          directionsService.route({
            origin: {'placeId': origin_place_id},
            destination: {'placeId': destination_place_id},
            travelMode: travel_mode
          }, function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            } else {
              window.alert('Directions request failed due to ' + status);
            }
          });
        }
      }
      */
</script>

    <iframe
    width="800px"
          height="500px"
          frameborder="0" style="border:0"
     src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyDh0_ZSX_J08OdNZm6Dt8ILq1FV37GqbOY&origin=30.2212966+71.5427211&destination=30.3039458383+71.929990987&avoid=tolls|highways"
      width="400px" height="400px"></iframe>
<?php
$latitude=strip_tags($_POST['startLat']);
$longitude=strip_tags($_POST['startLon']);
$auth_user->geo2address($latitude,$longitude);
 ?>
<?php
require_once('include/footer.php');
 ?>
