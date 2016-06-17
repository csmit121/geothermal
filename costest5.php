<?php
session_start();
// pass variables from previous page
$fluidt = $_SESSION["fluidt"];
$siteinvest = $_SESSION["siteinvest"];
$opcost = $_SESSION["opcost"];
$building_location = $_SESSION["building_location"];
$heat_peak_load = $_SESSION["heat_peak_load"];
$heat_total_load = $_SESSION["heat_total_load"];
$cool_peak_load = $_SESSION["cool_peak_load"];
$cool_total_load = $_SESSION["cool_total_load"];
$natgas_price = $_SESSION["natgas_price"];
$electricity_price = $_SESSION["electricity_price"];
$boiler_efficiency = $_SESSION["boiler_efficiency"];
$design_cop = $_SESSION["design_cop"];
$avg_cop = $_SESSION["avg_cop"];
$chlr_elec_con = $_SESSION["chlr_elec_con"];
$heat_rej_pr = $_SESSION["heat_rej_pr"];
$heat_rej_ec = $_SESSION["heat_rej_ec"];
$pump_pwr_ratio = $_SESSION["pump_pwr_ratio"];
$pump_elec_con = $_SESSION["pump_elec_con"];

//define variables and set to empty values
$transportation = $distance = $distunit = $netloadwl = $wlunit = $transportinitcost = $transportopcost = $fueltype = $fueleff = $loadtime = $avgvel = '';
$transportationerror = $distanceerror = $netloadwlerror = $transportinitcosterror = $transportopcosterror = $fuelefferror = $loadtimeerror = $avgvelerror = '';
$transportationmsg = $distancemsg = $netloadwlmsg = $transportinitcostmsg = $transportopcostmsg = $fueleffmsg = $loadtimemsg = $avgvelmsg = '';

// detect form field errors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["transportation"])) {
  $transportationerror = "*";
  $transportationmsg = "Please choose a transportation type.";
  } else { 
  $transportation = test_input($_POST["transportation"]);
  $_SESSION["transportation"] = $transportation;
  }
  
  if ($transportation == 'truck') {
	$fueltype = test_input($_POST['fueltype']);
	$_SESSION["fueltype"] = $fueltype;
  
  
  if (($_POST['distance'])=='') {
  $distanceerror = '* ';
  $distancemsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['distance'])) {
	$distanceerror = "* ";
	$distancemsg = "Please use numeric or decimal characters.";
  } else if (($_POST["distance"]) < 0 || ($_POST["distance"]) > 100) {
	$distanceerror = "* ";
	$distancemsg = "Value must be between 0 and 100.";
  } else { 
  $distance = test_input($_POST['distance']);
  $distunit = test_input($_POST['distunit']);
  $_SESSION["distance"] = $distance;
  $_SESSION["distunit"] = $distunit;
  }

  if (($_POST['netloadwl'])=='') {
  $netloadwlerror = '* ';
  $netloadwlmsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['netloadwl'])) {
	$netloadwlerror = "* ";
	$netloadwlmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["netloadwl"]) < 0 || ($_POST["netloadwl"]) > 27215) {
	$netloadwlerror = "* ";
	$netloadwlmsg = "Value must be between 0 and 27215.";
  } else { 
  $netloadwl = test_input($_POST['netloadwl']);
  $wlunit = test_input($_POST['wlunit']);
  $_SESSION["netloadwl"] = $netloadwl;
  $_SESSION["wlunit"] = $wlunit;
  }
  
  if (($_POST['transportinitcost'])=='') {
  $transportinitcosterror = '* ';
  $transportinitcostmsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['transportinitcost'])) {
	$transportinitcosterror = "* ";
	$transportinitcostmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["transportinitcost"]) < 0 || ($_POST["transportinitcost"]) > 1000000000) {
	$transportinitcosterror = "* ";
	$transportinitcostmsg = "Value must be between 0 and 1,000,000,000.";
  } else { 
  $transportinitcost = test_input($_POST['transportinitcost']);
  $_SESSION["transportinitcost"] = $transportinitcost;
  }
  
  if (($_POST['transportopcost'])=='') {
  $transportopcosterror = '* ';
  $transportopcostmsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['transportopcost'])) {
	$transportopcosterror = "* ";
	$transportopcostmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["transportopcost"]) < 0 || ($_POST["transportopcost"]) > 100000) {
	$transportopcosterror = "* ";
	$transportopcostmsg = "Value must be between 0 and 100,000.";
  } else { 
  $transportopcost = test_input($_POST['transportopcost']);
  $_SESSION["transportopcost"] = $transportopcost;
  }
  
  if (($_POST['fueleff'])=='') {
  $fuelefferror = '* ';
  $fueleffmsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['fueleff'])) {
	$fuelefferror = "* ";
	$fueleffmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["fueleff"]) < 0 || ($_POST["fueleff"]) > 100) {
	$fuelefferror = "* ";
	$fueleffmsg = "Value must be between 0 and 100.";
  } else { 
  $fueleff = test_input($_POST['fueleff']);
  $_SESSION["fueleff"] = $fueleff;
  }
  
  if (($_POST['loadtime'])=='') {
  $loadtimeerror = '* ';
  $loadtimemsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['loadtime'])) {
	$loadtimeerror = "* ";
	$loadtimemsg = "Please use numeric or decimal characters.";
  } else if (($_POST["loadtime"]) < 0 || ($_POST["loadtime"]) > 10) {
	$loadtimeerror = "* ";
	$loadtimemsg = "Value must be between 0 and 10.";
  } else { 
  $loadtime = test_input($_POST['loadtime']);
  $_SESSION["loadtime"] = $loadtime;
  }
  
  if (($_POST['avgvel'])=='') {
  $avgvelerror = '* ';
  $avgvelmsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['avgvel'])) {
	$avgvelerror = "* ";
	$avgvelmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["avgvel"]) < 0 || ($_POST["avgvel"]) > 100) {
	$avgvelerror = "* ";
	$avgvelmsg = "Value must be between 0 and 100.";
  } else { 
  $avgvel = test_input($_POST['avgvel']);
  $_SESSION["avgvel"] = $avgvel;
  }
  
  if ($transportation !='' && $distance !='' && $netloadwl !='' && $transportinitcost !='' && $transportopcost !='' && $fueltype !='' && $loadtime !='' && $avgvel != '') {
	  header('Location: costest6.php');
	  exit;
  }
  }
  
  if ($transportation == 'pipeline' || $transportation == 'railway') {
	  if($transportation !='') {
		$_SESSION["distance"] = $distance;
		$_SESSION["distunit"] = $distunit;
		$_SESSION["netloadwl"] = $netloadwl;
		$_SESSION["wlunit"] = $wlunit;
		$_SESSION["transportinitcost"] = $transportinitcost;
		$_SESSION["transportopcost"] = $transportopcost;
		$_SESSION["fueleff"] = $fueleff;
		$_SESSION["loadtime"] = $loadtime;
		$_SESSION["avgvel"] = $avgvel;
		$_SESSION["fueltype"] = $fueltype;
		header('Location: costest6.php');
		exit;
	  }
  }
}
 
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
  
<SCRIPT LANGUAGE="JavaScript">
function hidefields() {
	if(document.getElementById('pipeline').checked || document.getElementById('railway').checked) {
	document.getElementById('truckfields').hidden=true;
	document.getElementById('distance').value='';
	document.getElementById('distunit').value='';
	document.getElementById('netloadwl').value='';
	document.getElementById('wlunit').value='';
	document.getElementById('transportinitcost').value='';
	document.getElementById('transportopcost').value='';
	document.getElementById('fueltype').value='';
	document.getElementById('fueleff').value='';
	document.getElementById('loadtime').value='';
	document.getElementById('avgvel').value='';
	document.getElementById('velunit').value='';
	} else if(document.getElementById('truck').checked) {
	document.getElementById('truckfields').hidden=false;
	}
}

function defaults() {
	document.getElementById('truckfields').hidden=false;
	document.getElementById('truck').checked=true;
	document.getElementById('distance').value = 10;
	document.getElementById('distunit').value = "mi";
	document.getElementById('netloadwl').value = 27215;
	document.getElementById('wlunit').value = "kg";
	document.getElementById('transportinitcost').value = 0;
	document.getElementById('transportopcost').value = 52;
	document.getElementById('fueltype').value = "diesel";
	document.getElementById('fueleff').value = 5;
	document.getElementById('loadtime').value = 0.17;
	document.getElementById('avgvel').value = 40;
	document.getElementById('velunit').value = "mph";
}

window.onload = hidefields;
</script>  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Transportation Info</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="headerbar">
</div>
<div class="progresslabels">
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Geothermal Site Info<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Building Site Info<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Baseline System Info<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Choose Technology<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Transportation Info</b><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Project Info<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Calculate
</div>


<form class = "input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="transport">
<span class = "error"><?php echo $transportationerror;?></span><input type="radio" name="transportation" onclick="hidefields()" value="truck" id="truck" <?php if (isset($_POST['transportation']) && $_POST['transportation'] == 'truck') echo 'checked = "checked"';?>> truck 
<span class = "error"><?php echo $transportationerror;?></span><input type="radio" name="transportation" onclick="hidefields()" value="pipeline" id="pipeline" <?php if (isset($_POST['transportation']) && $_POST['transportation'] == 'pipeline') echo 'checked = "checked"';?>> pipeline 
<span class = "error"><?php echo $transportationerror;?></span><input type="radio" name="transportation" onclick="hidefields()" value="railway" id="railway" <?php if (isset($_POST['transportation']) && $_POST['transportation'] == 'railway') echo 'checked = "checked"';?>> railway
<br /><span class = "error"><?php echo $transportationmsg;?></span>
<div id="truckfields" hidden><br />
<span class = "error"><?php echo $distanceerror;?></span>Distance: <input type="text" name="distance" id="distance" size="10" value="<?php echo $distance;?>">
<select name="distunit" id="distunit">
	<option value="mi" <?php if($distunit=="mi") echo "selected='selected'";?>>mi</option>
	<option value="km" <?php if($distunit=="km") echo "selected='selected'";?>>km</option>
	</select>
<br /><span class = "error"><?php echo $distancemsg;?></span>
<br />
<span class = "error"><?php echo $netloadwlerror;?></span>Net Load Weight Limit: <input type="text" name="netloadwl" id="netloadwl" size="10" value="<?php echo $netloadwl;?>">
<select name="wlunit" id="wlunit">
	<option value="lbm" <?php if($wlunit=="lbm") echo "selected='selected'";?>>lbm</option>
	<option value="kg" <?php if($wlunit=="kg") echo "selected='selected'";?>>kg</option>
	</select>
<br /><span class = "error"><?php echo $netloadwlmsg;?></span>
<br />
<span class = "error"><?php echo $transportinitcosterror;?></span>Initial Cost: $<input type="text" name="transportinitcost" id="transportinitcost" size="10" value="<?php echo $transportinitcost;?>">
<br /><span class = "error"><?php echo $transportinitcostmsg;?></span>
<br />
<span class = "error"><?php echo $transportopcosterror;?></span>Operating Cost: $<input type="text" name="transportopcost" id="transportopcost" size="10" value="<?php echo $transportopcost;?>">/hr
<!--<select name="unit" id="unit">
	<option value="unit1">Unit 1</option>
	<option value="unit2">Unit 2</option>
	<option value="unit3">Unit 3</option>
	</select>-->
<br /><span class = "error"><?php echo $transportopcostmsg;?></span>
<br />
Fuel Type: <select name="fueltype" id="fueltype">
	<option value="diesel" <?php if($fueltype=="diesel") echo "selected='selected'";?>>Diesel</option>
	<option value="gasoline" <?php if($fueltype=="gasoline") echo "selected='selected'";?>>Gasoline</option>
	</select>
<br />
<br />
<span class = "error"><?php echo $fuelefferror;?></span>Fuel Efficiency: <input type="text" name="fueleff" id="fueleff" size="10" value="<?php echo $fueleff;?>"> mpg
<br /><span class = "error"><?php echo $fueleffmsg;?></span>
<br />
<span class = "error"><?php echo $loadtimeerror;?></span>Loading Time: <input type="text" name="loadtime" id="loadtime" size="10" value="<?php echo $loadtime;?>">/hr
<!--<select name="unit" id="unit">
	<option value="unit1">Unit 1</option>
	<option value="unit2">Unit 2</option>
	<option value="unit3">Unit 3</option>
	</select>-->
<br /><span class = "error"><?php echo $loadtimemsg;?></span>
<br />
<span class = "error"><?php echo $avgvelerror;?></span>Average Velocity: <input type="text" name="avgvel" id="avgvel" size="10" value="<?php echo $avgvel;?>">/<select name="velunit" id="velunit">
	<option value="mph">mph</option>
	<option value="km/h">km/h</option>
	</select>
<br /><span class = "error"><?php echo $avgvelmsg;?></span></div>
<br />
<button type="button" onclick="defaults()">Use Default Values</button>
<br/>
<br/>
<input type="button" value="Previous" onclick="history.go(-1);return true;">
<input type="submit" value="Next">

</form>
</body>
</html>
