<?php
include("DocumentationProfile.php");
//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 

$docObject = new DocumentationProfile();
$docObject->initialize("getDocumentationProfile.php",$_SERVER['REQUEST_URI']);
//$docObject->printClass();
$docObject->buildSQLquery("Yes");
$docObject->executeQuery("Yes");
$jsonArray = array();
$jsonArray['infoData']=$docObject->getInfoArray();
$jsonArray['chartData']=$docObject->getChartArray();
$jsonArray['mapData']=$docObject->getMapDataArray();
$jsonArray['pieChartData']=$docObject->getPieChartArray();
$jsonArray['columnData']=$docObject->getBarChartYesArray();
$jsonArray['barChartYesData']=$docObject->getMapDataArray();
$docObject->buildSQLquery("No");
$docObject->executeQuery("No");
$jsonArray['barChartNoData']=$docObject->getMapDataArray();
$docObject->buildSQLquery("Not Selected");
$docObject->executeQuery("Not Selected");
$jsonArray['barChartNotSelectedData']=$docObject->getMapDataArray();
echo json_encode($jsonArray);