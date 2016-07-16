<?php
include('config.php');
include('class.user.php');
try {
    $obj = new USER();
//    $stmt = $obj->getProvinceByCountry($_GET["id"]);

   $stmt = $obj->getProvinceByCountry($_GET["id"]);
  //  echo "{";
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
  //    echo '"'.$result['ProvinceID'].'":"'.$result['ProvinceName'].'",';
$arr= array($result{'ProvinceID'}=>$result{'ProvinceName'});
echo json_encode($arr);

//$result= $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  //  echo "}";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
header('Content-type: application/json');
echo json_encode($result);
?>
