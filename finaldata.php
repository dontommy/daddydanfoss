<?php
include('config.php');
$stamp = time();
$day = date('Y-m-d',$stamp);
$month = date('Y-m-00',$stamp);
$month2 = date('Y-m',$stamp);
$year = date('Y-00-00',$stamp);
$year2 = date('Y',$stamp);

// INSERT DAGS DATO
$sql = "SELECT id FROM finaldata WHERE thetime LIKE '$day%'";
$result = $objconn->query($sql);
if($result->num_rows == 0) {
	$insert = "INSERT INTO finaldata (thetime,thetype) VALUES ('$day','day')";
	$res = $objconn->query($insert);
}
// INSERT MONTH
$sql = "SELECT id FROM finaldata WHERE thetime LIKE '$month%'";
$result = $objconn->query($sql);
if($result->num_rows == 0) {
        $insert = "INSERT INTO finaldata (thetime,thetype) VALUES ('$month','mon')";
        $res = $objconn->query($insert);
}
// INSERT YEAR
$sql = "SELECT id FROM finaldata WHERE thetime LIKE '$year%'";
$result = $objconn->query($sql);
if($result->num_rows == 0) {
        $insert = "INSERT INTO finaldata (thetime,thetype) VALUES ('$year','year')";
        $res = $objconn->query($insert);
}



// UPDATE DAGS DATO 
$sql = "SELECT data FROM today WHERE thetime LIKE '$day%' ORDER BY thetime DESC LIMIT 1";
$result = $objconn->query($sql);
while($row = $result->fetch_assoc()) {
	$newdata = $row['data'];
}
$sql = "UPDATE finaldata SET thedata = '$newdata' WHERE thetime LIKE '$day%' AND thetype = 'day'";
$result = $objconn->query($sql);

// UPDATE MONTH
$sql = "SELECT SUM(thedata) FROM finaldata WHERE thetime LIKE '$month2%' AND thetype = 'day'";
$result = $objconn->query($sql);
while($row = $result->fetch_assoc()) {
	$newdata = $row['SUM(thedata)'];
}
$sql = "UPDATE finaldata SET thedata = '$newdata' WHERE thetime LIKE '$month%' AND thetype = 'mon'";
$result = $objconn->query($sql);

// UPDATE YEAR
$sql = "SELECT SUM(thedata) FROM finaldata WHERE thetime LIKE '$year2%' AND thetype = 'mon'";
$result = $objconn->query($sql);
while($row = $result->fetch_assoc()) { 
        $newdata = $row['SUM(thedata)'];
}
$sql = "UPDATE finaldata SET thedata = '$newdata' WHERE thetime LIKE '$year%' AND thetype = 'year'";
$result = $objconn->query($sql);



?>
