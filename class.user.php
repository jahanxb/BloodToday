<?php
require_once('config.php');
class USER
{
private $conn;
public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
/*
		public function getCountry() {
			$stmt =$this->conn->prepare("SELECT * FROM country");
			$stmt->execute();
      	return $stmt;
		}
	public function getProvince(){
			$stmt =$this->conn->prepare("SELECT * FROM province WHERE Country_CountryID='".$_GET["id"]."'");

			$stmt->execute();
			return $stmt;
		}
		*/

		// stackOverflow
		public function getCountry() {
		    $stmt = $this->conn->query("SELECT * FROM country"); // no need to use prepare() as you are not using any untrusted data
		    return $stmt;

				          //    while($stmt=mysql_fetch_assoc($list)){


		}
public function donorComplaint($contactedBy,$contactedTo,$DonorProfile_DonorID,$person_PersonID,$complaintINFO){
	$stmt = $this->conn->prepare("INSERT INTO donorinfo(contactedBy,contactedTo,DonorProfile_DonorID,person_PersonID,complaintINFO)
						 VALUES(:contactedBy, :contactedTo,:DonorProfile_DonorID,:person_PersonID,:complaintINFO)");
//$stmt2 = $this->conn->prepare("SELECT userID,email FROM user WHERE email=:email");
//INSERT INTO `person` (`FirstName`, `LastName`, `Date_of_birth`, `Gender`, `bloodGroup`, `user_userID`)
//VALUES ('Tony', 'Stark', '1995-04-05', 'male', 'B+', '6');

	$stmt->bindparam(":contactedBy", $contactedBy);
	$stmt->bindparam(":contactedTo", $contactedTo);
	$stmt->bindparam(":DonorProfile_DonorID", $DonorProfile_DonorID);
	$stmt->bindparam(":person_PersonID", $person_PersonID);
	$stmt->bindparam(":complaintINFO", $complaintINFO);

		//		$stmt1->bindparam(":User_UserID",$UserID);
	$stmt->execute();
	//$this->$pdo->lastInsertId("user");
	return $stmt;

}
public function recipientComplaint($contactedBy,$contactedTo,$Recipient_RecipientID,$person_PersonID,$complaintINFO){
	$stmt = $this->conn->prepare("INSERT INTO recpinfo(contactedBy,contactedTo,Recipient_RecipientID,person_PersonID,complaintINFO)
						 VALUES(:contactedBy, :contactedTo,:Recipient_RecipientID,:person_PersonID,:complaintINFO)");
//$stmt2 = $this->conn->prepare("SELECT userID,email FROM user WHERE email=:email");
//INSERT INTO `person` (`FirstName`, `LastName`, `Date_of_birth`, `Gender`, `bloodGroup`, `user_userID`)
//VALUES ('Tony', 'Stark', '1995-04-05', 'male', 'B+', '6');

	$stmt->bindparam(":contactedBy", $contactedBy);
	$stmt->bindparam(":contactedTo", $contactedTo);
	$stmt->bindparam(":Recipient_RecipientID", $Recipient_RecipientID);
	$stmt->bindparam(":person_PersonID", $person_PersonID);
	$stmt->bindparam(":complaintINFO", $complaintINFO);

		//		$stmt1->bindparam(":User_UserID",$UserID);
	$stmt->execute();
	//$this->$pdo->lastInsertId("user");
	return $stmt;

}


public function history_1($contactedBy,$contactedTo,$DonorFlag,$DateTime){
	$stmt = $this->conn->prepare("INSERT INTO history(contactedBy,contactedTo,DonorFlag,DateTime)
						 VALUES(:contactedBy, :contactedTo, :DonorFlag,:DateTime)");
//$stmt2 = $this->conn->prepare("SELECT userID,email FROM user WHERE email=:email");
//INSERT INTO `person` (`FirstName`, `LastName`, `Date_of_birth`, `Gender`, `bloodGroup`, `user_userID`)
//VALUES ('Tony', 'Stark', '1995-04-05', 'male', 'B+', '6');

	$stmt->bindparam(":contactedBy", $contactedBy);
	$stmt->bindparam(":contactedTo", $contactedTo);
	$stmt->bindparam(":DonorFlag",$DonorFlag);
	$stmt->bindparam(":DateTime",$DateTime);
	//$stmt->bindparam(":Time",$Time);

		//		$stmt1->bindparam(":User_UserID",$UserID);
	$stmt->execute();
	//$this->$pdo->lastInsertId("user");
	return $stmt;

}
public function history_recp($contactedBy,$contactedTo,$RecipientFlag,$DateTime){
	$stmt = $this->conn->prepare("INSERT INTO history(contactedBy,contactedTo,RecipientFlag,DateTime)
						 VALUES(:contactedBy,:contactedTo,:RecipientFlag,:DateTime)");
//$stmt2 = $this->conn->prepare("SELECT userID,email FROM user WHERE email=:email");
//INSERT INTO `person` (`FirstName`, `LastName`, `Date_of_birth`, `Gender`, `bloodGroup`, `user_userID`)
//VALUES ('Tony', 'Stark', '1995-04-05', 'male', 'B+', '6');

	$stmt->bindparam(":contactedBy",$contactedBy);
	$stmt->bindparam(":contactedTo",$contactedTo);
	$stmt->bindparam(":RecipientFlag",$RecipientFlag);
	$stmt->bindparam(":DateTime",$DateTime);
	//$stmt->bindparam(":Time",$Time);

		//		$stmt1->bindparam(":User_UserID",$UserID);
	$stmt->execute();
	//$this->$pdo->lastInsertId("user");
	return $stmt;

}




		public function getPersonDetail(){
			$stmt= $this->conn->prepare("SELECT person.LastName,country.CountryName, province.ProvinceName, city.CityName ,
				 cityarea.CityAreaName, person.FirstName, person.bloodGroup
				 from person JOIN address on person.PersonID=address.person_PersonID
				 JOIN country on country.CountryID=address.Country_CountryID
				  JOIN province on address.Province_ProvinceID=province.ProvinceID
					 join city on city.CityID=address.City_CityID join cityarea on cityarea.CityAreaID=address.CityArea_CityAreaID");
			$stmt->execute();
			    return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getPersonSearchDetail($country, $province, $city, $bloodGroup){
			$stmt= $this->conn->prepare("SELECT person.PersonID,person.LastName,country.CountryName, province.ProvinceName, city.CityName ,
			cityarea.CityAreaName,cityarea.BlockNo,cityarea.StreetNo,cityarea.HouseNo, person.FirstName, person.bloodGroup,user.phoneNo,user.email,person.Date_of_birth,person.Gender,
			donorprofile.LastBleedDate,donorprofile.counter,donorprofile.BodyWeight,donorprofile.RecipientDetail,donorprofile.DonorID

			from person JOIN address on person.PersonID=address.person_PersonID

			 JOIN country on country.CountryID=address.Country_CountryID
			JOIN user on user.userID=person.user_userID
			JOIN province on address.Province_ProvinceID=province.ProvinceID
			 join city on city.CityID=address.City_CityID
			 join cityarea on	cityarea.CityAreaID=address.CityArea_CityAreaID
			 	JOIN donorprofile on donorprofile.person_PersonID=person.PersonID
			  where address.Country_CountryID = ?
				 AND address.Province_ProvinceID = ?
			AND address.City_CityID=?
			 AND person.bloodGroup = ?");

	//	 $stmt=$this->conn->prepare("SELECT currentlocation.latitude,currentlocation.longitude,currentlocation.DateTime, person.PersonID from currentlocation,person
	//	  WHERE currentlocation.person_PersonID=person.personID ")
			$stmt->execute(array($country, $province, $city, $bloodGroup));
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
			// User Complaint OLD (which was supposed to store everything in history)
/*				public function getComplaintUser($email,$contactedBy,$contactedTo){
					try{
						$stmt = $this->conn->prepare("INSERT INTO history(contactedBy,contactedTo,emailComplaint)
																															 VALUES(:contactedBy,:contactedTo,:emailComplaint)");
						 //VALUES (SELECT(UserID FROM user WHERE = UserID=User_UserID)
						//$user_id = mysql_insert_id( $conn );
									$stmt->bindparam(":contactedBy", $contactedBy);
									$stmt->bindparam(":contactedTo", $contactedTo);
									$stmt->bindparam(":emailComplaint", $email);

									$stmt->execute();

									return $stmt;

*/
//this code is also this function part for future references
/*

					$stmt= $this->conn->prepare("SELECT user.userID, person.PersonID,person.LastName,
						country.CountryName, province.ProvinceName, city.CityName ,
					cityarea.CityAreaName,cityarea.BlockNo,cityarea.StreetNo,
					cityarea.HouseNo, person.FirstName, person.bloodGroup,
					user.phoneNo,user.email,person.Date_of_birth,person.Gender

					from person JOIN address on person.PersonID=address.person_PersonID

					 JOIN country on country.CountryID=address.Country_CountryID
					JOIN user on user.userID=person.user_userID
					JOIN province on address.Province_ProvinceID=province.ProvinceID
					 join city on city.CityID=address.City_CityID
					 join cityarea on	cityarea.CityAreaID=address.CityArea_CityAreaID

					  where user.email=?");


			//	 $stmt=$this->conn->prepare("SELECT currentlocation.latitude,currentlocation.longitude,currentlocation.DateTime, person.PersonID from currentlocation,person
			//	  WHERE currentlocation.person_PersonID=person.personID ")
					$stmt->execute(array($email));
					return $stmt->fetchAll(PDO::FETCH_ASSOC);

// also add *|/| remove these ||

}
catch(PDOException $e) {

	echo $e->getMessage();
}
				}
*/
public function getComplaintUserDetail($contactedTo){
	$stmt= $this->conn->prepare("SELECT user.userID, person.PersonID,person.LastName,
		country.CountryName, province.ProvinceName, city.CityName ,
	cityarea.CityAreaName,cityarea.BlockNo,cityarea.StreetNo,
	cityarea.HouseNo, person.FirstName, person.bloodGroup,
	user.phoneNo,user.email,person.Date_of_birth,person.Gender

	from person JOIN address on person.PersonID=address.person_PersonID

	 JOIN country on country.CountryID=address.Country_CountryID
	JOIN user on user.userID=person.user_userID
	JOIN province on address.Province_ProvinceID=province.ProvinceID
	 join city on city.CityID=address.City_CityID
	 join cityarea on	cityarea.CityAreaID=address.CityArea_CityAreaID

		where user.email=?");


//	 $stmt=$this->conn->prepare("SELECT currentlocation.latitude,currentlocation.longitude,currentlocation.DateTime, person.PersonID from currentlocation,person
//	  WHERE currentlocation.person_PersonID=person.personID ")
	$stmt->execute(array($contactedTo));
	return $stmt->fetchAll(PDO::FETCH_ASSOC);


}


		// now Search for recipient
		public function getPersonSearchDetailForRecipient($country, $province, $city, $emergency) {
			$stmt= $this->conn->prepare("SELECT person.LastName,recipient.CurrentlyNeed,country.CountryName, province.ProvinceName, city.CityName,
			cityarea.CityAreaName,cityarea.BlockNo,cityarea.StreetNo,cityarea.HouseNo, person.PersonID,person.FirstName, person.bloodGroup ,recipient.CurrentlyNeed,user.email,person.Date_of_birth,person.gender,
			user.phoneNo,recipient.RecievedBloodDate,recipient.RecievedBloodQuantity,recipient.CentreOrHospital,recipient.ReasonCauseDisease,recipient.RecipientID
			from person JOIN address on person.PersonID=address.person_PersonID
			JOIN user on  person.user_userID= user.userID
			JOIN country on country.CountryID=address.Country_CountryID
			JOIN province on address.Province_ProvinceID=province.ProvinceID join city on city.CityID=address.City_CityID join cityarea on
			cityarea.CityAreaID=address.CityArea_CityAreaID join recipient on recipient.person_PersonID=person.personID where address.Country_CountryID = ? AND address.Province_ProvinceID = ?
			AND address.City_CityID=? AND recipient.CurrentlyNeed = ?");

			$stmt->execute(array($country, $province, $city, $emergency));
			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

		// renamed
		public function getProvinceByCountry($id) {
		    $stmt = $this->conn->prepare("SELECT * FROM province WHERE Country_CountryID =?"); // notice the '?' ?
		    $stmt->execute(array($id));
		    return $stmt;
		}
		//end stack
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function register($email,$phoneNo,$password)
	{
		try
		{
		//	$new_password = password_hash($password, PASSWORD_DEFAULT);
$new_password= md5($password);
$stmt = $this->conn->prepare("INSERT INTO user(email,phoneNo,password)
		                                               VALUES(:email, :phoneNo, :password)");
 //VALUES (SELECT(UserID FROM user WHERE = UserID=User_UserID)
//$user_id = mysql_insert_id( $conn );
			$stmt->bindparam(":email", $email);
			$stmt->bindparam(":phoneNo", $phoneNo);
			$stmt->bindparam(":password", $new_password);
			$stmt->execute();

			return $stmt;

			}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function registerPerson($FirstName,$LastName,$Date_of_birth,$Gender,$bloodGroup,$user_userID) {
		$stmt1 = $this->conn->prepare("INSERT INTO person(FirstName,LastName,Date_of_birth,Gender,bloodGroup,user_userID)
							 VALUES(:FirstName, :LastName, :Date_of_birth,:Gender,:bloodGroup,:user_userID)");
//$stmt2 = $this->conn->prepare("SELECT userID,email FROM user WHERE email=:email");
//INSERT INTO `person` (`FirstName`, `LastName`, `Date_of_birth`, `Gender`, `bloodGroup`, `user_userID`)
 //VALUES ('Tony', 'Stark', '1995-04-05', 'male', 'B+', '6');

		$stmt1->bindparam(":FirstName", $FirstName);
		$stmt1->bindparam(":LastName", $LastName);
		$stmt1->bindparam(":Date_of_birth", $Date_of_birth);
		$stmt1->bindparam(":Gender", $Gender);
		$stmt1->bindparam(":bloodGroup", $bloodGroup);
    $stmt1->bindparam(":user_userID",$user_userID);

			//		$stmt1->bindparam(":User_UserID",$UserID);
		$stmt1->execute();
		//$this->$pdo->lastInsertId("user");
		return $stmt1;

	}
	public function addAddress ($country,$province,$city,$cityAreaName,$blockNo,$streetNo,$houseNo, $PersonID){
		try
		{



			$stmt = $this->conn->prepare("INSERT INTO cityarea (cityAreaName, BlockNo, StreetNo, HouseNo, City_CityID)
			VALUES(:cityAreaName,:BlockNo ,:StreetNo,:HouseNo, :City_CityID);");
			$stmt->bindparam(":cityAreaName", $cityAreaName);
			$stmt->bindparam(":BlockNo", $blockNo);
			$stmt->bindparam(":StreetNo", $streetNo);
			$stmt->bindparam(":HouseNo", $houseNo);
			$stmt->bindparam(":City_CityID", $city);

			$stmt->execute();
	//		$st=$this->conn->query("SELECT * FROM cityArea");
		/*				$q =$this->conn->query("Select cityAreaID from cityarea");

			foreach($this->conn->query($q) as $obj){
				$areaid = $obj['cityAreaID'];
			}
			*/
			 $last_id = $this->conn->lastInsertId();


					$stmt = $this->conn->prepare("INSERT INTO address (Country_CountryID, Province_ProvinceID, City_CityID, cityArea_cityAreaID, person_PersonID)
																												 VALUES(:country,:province ,:city,:area, :person);");
							 $stmt->bindparam(":country", $country);
							 $stmt->bindparam(":province", $province);
							 $stmt->bindparam(":city", $city);
						 $stmt->bindparam(":area", $last_id);
						 $stmt->bindparam(":person", $PersonID);

						$stmt->execute();

			return $stmt;

			}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}


//function optionalCity ($cityAreaName,$blockname,$streetno,$houseno){
//}
	}
// function for dnrecp.php file
public function donorRecp ($lastbleedDate,$bodyWeight,$donatedHospital,$TestDate,$BloodTestTaken,$TestCentreOrHospital,$person_PersonID){

				try {

					$stmt = $this->conn->prepare("INSERT INTO donorprofile (LastBleedDate,BodyWeight,RecipientDetail,person_PersonID)
																												 VALUES(:lastbleedDate,:bodyWeight,:donatedHospital,:person_PersonID);");
							 $stmt->bindparam(":lastbleedDate", $lastbleedDate);
							 $stmt->bindparam(":bodyWeight", $bodyWeight);
							 $stmt->bindparam(":donatedHospital",$donatedHospital);
							 $stmt->bindparam(":person_PersonID",$person_PersonID);

						$stmt->execute();
						$last_id = $this->conn->lastInsertId();
						$stmt=$this->conn->prepare("INSERT INTO testtype (TestDate,BloodTestTaken,TestCentreOrHospital,DonorProfile_DonorID)
						 													VALUES (:TestDate,:BloodTestTaken,:TestCentreOrHospital,:DonorProfile_DonorID)");
																			$stmt->bindparam(":TestDate", $TestDate);
																			$stmt->bindparam(":BloodTestTaken", $BloodTestTaken);
																			$stmt->bindparam(":TestCentreOrHospital",$TestCentreOrHospital);
																			$stmt->bindparam(":DonorProfile_DonorID",$last_id);

											$stmt->execute();
			return $stmt;

				}
				catch (PDOException $e){
					echo $e->getMessage();
				}
}
public function RecpREG($RecievedBloodDate,$ReasonCauseDisease,$CurrentlyNeed,$CentreOrHospital,$RecievedBloodQuantity,$RefferedByWhom,$person_PersonID) {

				try {
							$stmt=$this->conn->prepare("INSERT INTO recipient (RecievedBloodDate,ReasonCauseDisease,CurrentlyNeed,CentreOrHospital,RecievedBloodQuantity,RefferedByWhom,person_PersonID)
																				VALUES (:RecievedBloodDate,:ReasonCauseDisease,:CurrentlyNeed,:CentreOrHospital,:RecievedBloodQuantity,:RefferedByWhom,:person_PersonID);");
												$stmt->bindparam(":RecievedBloodDate",$RecievedBloodDate);
												$stmt->bindparam(":ReasonCauseDisease",$ReasonCauseDisease);
												$stmt->bindparam(":CurrentlyNeed",$CurrentlyNeed);
												$stmt->bindparam(":CentreOrHospital",$CentreOrHospital);
												$stmt->bindparam(":RecievedBloodQuantity",$RecievedBloodQuantity);
												$stmt->bindparam(":RefferedByWhom",$RefferedByWhom);
												$stmt->bindparam(":person_PersonID",$person_PersonID);

									$stmt->execute();
									return $stmt;
				}
					catch (PDOException $e){
						echo $e->getMessage();
					}
}

public function checkAddress ($stupid_id)
{
	$stmt= $this->conn->prepare("select * from address WHERE person_PersonID=:person_PersonID");
	$stmt->execute(array(':person_PersonID'=>$stupid_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount()>0)
	{
	$this->redirect('dnrecp.php');
	}

}
// edit Profile Functions
/*
public function fetchProfile (){
$stmt = $this->conn->prepare("SELECT * FROM user,person,address,city,country,province,recipient,donorprofile
WHERE user.userID=person.user_userID AND person.PersonID=address.person_PersonID

");

}
*/
public function editProfile($stupid_id){


	$stmt=$this->conn->prepare("select * from person WHERE PersonID=:PersonID");
	$stmt->execute(array(':PersonID'=>$stupid_id));
	try {
	$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

//$stmt->execute();
//var_dump($userRow->fetchAll());
	foreach ($userRow as $row) {
	echo $row["FirstName"]."&emsp;".$row['LastName']."&emsp;".$row['Date_of_birth']."&emsp;".$row['Gender']."&emsp;".$row['bloodGroup'];
}

$stmt1=$this->conn->prepare("select person.PersonID,
 address.AddressID,country.CountryName, province.ProvinceName,
  city.CityName ,cityarea.BlockNo,cityarea.StreetNo,cityarea.HouseNo,
	 cityarea.CityAreaName, person.FirstName from country, address, province, city, cityarea, person
  where PersonID=:person_PersonID AND person.PersonID = address.person_PersonID
	  AND country.CountryID=address.Country_CountryID
		 AND province.ProvinceID=address.Province_ProvinceID AND city.CityID=address.City_CityID
  AND cityarea.CityAreaID=address.CityArea_CityAreaID");

//	$stmt1=$this->conn->prepare("select * from address ,person,country,city,province,cityarea WHERE PersonID=:person_PersonID");
$stmt1->execute(array(':person_PersonID'=>$stupid_id));
$userRow1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
echo "<br>";
foreach ($userRow1 as $row){
	echo $row["AddressID"]."&emsp;".$row["CountryName"]."&emsp;".$row['ProvinceName']."&emsp;".$row['CityName']."&emsp;".$row['CityAreaName']."&emsp;".$row['BlockNo']."&emsp;".$row['StreetNo']."&emsp;".$row['HouseNo'];
}

	$stmt1=$this->conn->prepare("SELECT * from donorprofile WHERE person_PersonID=:person_PersonID");
	$stmt1->execute(array(':person_PersonID' => $stupid_id));
	$userRow1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
	echo "<br>";
						foreach ($userRow1 as $row) {

							echo $row['LastBleedDate']."&emsp;".$row['RecipientDetail']."&emsp;".$row['BodyWeight'];
						}
//recipient
$stmt1=$this->conn->prepare("SELECT * from recipient WHERE person_PersonID=:person_PersonID");
$stmt1->execute(array(':person_PersonID' => $stupid_id));
$userRow1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
echo "<br>";
					foreach ($userRow1 as $row) {

						echo $row['RecievedBloodDate']."&emsp;".$row['RecievedBloodQuantity']."&emsp;".$row['RefferedByWhom']."&emsp;".$row['ReasonCauseDisease']."&emsp;".$row['CurrentlyNeed'];
					}


}
catch (PDOException $e) {
	echo $e->getMessage();
 			}
							}

public function checkDonorRecp ($stupid_id)
{
	$stmt= $this->conn->prepare("select * from recipient WHERE person_PersonID=:person_PersonID");
	$stmt->execute(array(':person_PersonID'=>$stupid_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount()>0)
	{
	$this->redirect('index.php');
	}

}
public function checkPerson ($stupid_id_P)
{
	$stmt= $this->conn->prepare("select * from person WHERE PersonID=:PersonID");
	$stmt->execute(array(':PersonID'=>$stupid_id_P));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount()>0)
	{
	$this->redirect('home.php');
	}

}


public function insertRandomNumber($number){
		$stmt = $this->conn->prepare("Update user SET RandomNumber=:RandomNumber WHERE userID=:userID");
		$stmt->bindparam(":RandomNumber", $number);
		$stmt->bindparam(":userID", $_SESSION['user_session']);
		$stmt->execute();

}
public function getRandomNumber(){
	$stmt = $this->conn->prepare("Select RandomNumber From user Where userID=:userID");
	//$id=$_SESSION['user_session'];
	$stmt->bindparam(":userID", $_SESSION['user_session']);

	$stmt->execute();
	$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
	return $userRow['RandomNumber'];
}
public function getFlag(){
	$stmt = $this->conn->prepare("Select UserConfirm From user Where userID=:userID");
		$stmt->bindparam(":userID", $_SESSION['user_session']);
	$stmt->execute();
	$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount()==1){
		return $userRow['UserConfirm'];
	}
	else
		return -1;
}
public function getEmailofUser(){
	$stmt = $this->conn->prepare("Select email From user Where userID=?");
	$stmt->execute(array($_SESSION['user_session']));
	$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount()==1){
		return $userRow['email'];
	}
	else
		return -1;
}

public function updateFlag($status){
	$stmt = $this->conn->prepare("Update user SET UserConfirm=:UserConfirm WHERE userID=:userID");
	$stmt->bindparam(":UserConfirm", $status);
	$stmt->bindparam(":userID", $_SESSION['user_session']);
	$stmt->execute();
}
	public function doLogin($email,$password)
	{
		try
		{
			$new_password=md5($password);
			$stmt = $this->conn->prepare("SELECT userID, email, password FROM user WHERE email=:email");
			$stmt->execute(array(':email'=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
			//	if(password_verify($new_password, $userRow['password']))
if ($new_password==$userRow['password'])
				{
					$_SESSION['user_session'] = $userRow['userID'];
					return true;
				}
				else
				{

					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function is_loggedin()
				{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
// Not Operational right now we are using getFlag(); function for checking verification
	public function is_verify(){

	//	if(isset($_SESSION['user_session'])){
	$stmt = $this->conn->prepare("Select UserConfirm From user Where userID=?");
	$stmt->execute(array($_SESSION['user_session']));
	$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($userRow['UserConfirm']==""){

		$this->redirect("verify.php");
		}

	//	}
	}


	// Get address from Cordinates
	function geo2address($lat,$lng)
  {
     $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
     $json = @file_get_contents($url);
     $data=json_decode($json);
     $status = $data->status;
     if($status=="OK")
     {
       echo $data->results[0]->formatted_address;
     }
     else
     {
       return false;
     }
  }

public function redirect($url)
	{
    try {
	  	header("location: ".$url);
		//	{
				// Jaxxy hates this line of Code
			/*    if (!headers_sent())
			    {
			        header('Location: '.$url);
			      // exit;
			        }
			    else
			        {
			        echo '<script type="text/javascript">';
			        echo 'window.location.href="'.$url.'";';
			        echo '</script>';
			        echo '<noscript>';
			        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			        echo '</noscript>'; exit;
			    }
			}
*/
 }
catch(PDOException $e)
	{
		echo $e->getMessage();
	 }
  			}

public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>
