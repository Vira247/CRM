<?php 
$con = mysqli_connect("villohome-prod.cdzjsvzvwd1x.us-west-2.rds.amazonaws.com","admin","MOMUjNkvFbbRQfDf","villohome");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$arraylist = array();
// Perform query
if ($result = mysqli_query($con, "SELECT * FROM wp_view_orderstatus")) {
  //echo "Returned rows are: " . mysqli_num_rows($result);
  // Free result set
  while($row = mysqli_fetch_assoc($result)) {
	  
 $arraylist[] = $row;
  }
  mysqli_free_result($result);
}
mysqli_close($con);
$n = 0;
$datetime = date('Y-m-d H:i:s');

//echo "<pre>"; print_r($arraylist); die;
$con = mysqli_connect("localhost","villospe_cdm","admin#000#","villospe_cdm");

mysqli_query($con,'TRUNCATE TABLE `orderlist`');
foreach($arraylist as $list){
   $count = 0;
   $fields = '';
	foreach($list as $col => $val) {
		if($val != ""){
		
		//echo $col ."=". $val."<br>";
		if ($count++ != 0) $fields .= ', ';
		//$col = mysql_real_escape_string($col);
		//$val = mysql_real_escape_string($val);
		$val = str_replace("'",'',$val);
		$fields .= "`$col` = '$val'";
		}
	}
			$insertQuery = "INSERT INTO orderlist SET $fields";
			if(mysqli_query($con,$insertQuery) === TRUE) {
			$n++;
			}else {
    echo "Error: " . $insertQuery . "<br>" . $conn->error; die();
}
	}
echo "data sync successfully you got ".$n." new data";
?>