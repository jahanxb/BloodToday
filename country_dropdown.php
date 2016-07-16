<?php
include('config.php');
include('class.user.php');
try {
    $obj = new USER();
    $stmt = $obj->getCountry();
  //  echo "{";
   while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
  //    echo '"'.$result['CountryID'].'":"'.$result['CountryName'].'",';
$arr = array ($result['CountryID']=>$result['CountryName']);
echo json_encode($arr);
   }
//    echo "}";
 //$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

header('Content-type: application/json');
//echo json_encode($result);
?>
