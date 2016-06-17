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
$transportation = $_SESSION["transportation"];
$distance = $_SESSION["distance"];
$netloadwl = $_SESSION["netloadwl"];
$transportinitcost = $_SESSION["transportinitcost"];
$transportopcost = $_SESSION["transportopcost"];
$fueltype = $_SESSION["fueltype"];
$fueleff = $_SESSION["fueleff"];
$loadtime = $_SESSION["loadtime"];
$avgvel = $_SESSION["avgvel"];

// define variables and set to empty values
$lifetime = $discount = '';
$lifetimeerror = $discounterror = '';
$lifetimemsg = $discountmsg = '';

// detect form field errors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["lifetime"])) {
	  $lifetimeerror = "* ";
	$lifetimemsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['lifetime'])) {
	$lifetimeerror = "* ";
	$lifetimemsg = "Please use numeric or decimal characters.";
  } else if (($_POST["lifetime"]) < 0 || ($_POST["lifetime"]) > 100) {
	$lifetimeerror = "* ";
	$lifetimemsg = "Value must be between 0 and 100.";
  } else { 
  $lifetime = test_input($_POST['lifetime']);
  $_SESSION["lifetime"] = $lifetime;
  }

  if (empty($_POST["discount"])) {
	  $discounterror = "* ";
	$discountmsg = 'Please enter a value.';
  } else if (!is_numeric($_POST['discount'])) {
	$discounterror = "* ";
	$discountmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["discount"]) < 0 || ($_POST["discount"]) > 100) {
	$discounterror = "* ";
	$discountmsg = "Value must be between 0 and 100.";
  } else { 
  $discount = test_input($_POST['discount']);
  $_SESSION["discount"] = $discount;
  }
  
  if ($lifetime !='' && $discount !='') {
	  header('Location: results.php');
	  exit;
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
function defaults() {
	document.getElementById('lifetime').value=20;
	document.getElementById('discount').value=3;
}
</script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Project Info</title>
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
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Transportation Info<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Project Info</b><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Calculate
</div>


<form class = "input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="projectinfo">

<span class="error"><?php echo $lifetimeerror;?></span>Lifetime: <input type="text" name="lifetime" id="lifetime" size="10" value="<?php echo $lifetime;?>"> years
<!--<select name="unit" id="unit">
	<option value="unit1">Unit 1</option>
	<option value="unit2">Unit 2</option>
	<option value="unit3">Unit 3</option>
	</select>-->
<br /><span class="error"><?php echo $lifetimemsg;?></span>
<br />
<span class="error"><?php echo $discounterror;?></span>Discount Rate: <input type="text" name="discount" id="discount" size="10" value="<?php echo $discount;?>">%
<br /><span class="error"><?php echo $discountmsg;?></span>
<br />
<button type="button" onclick="defaults()">Use Default Values</button>
<br/>
<br/>
<input type="button" value="Previous" onclick="history.go(-1);return true;">
<input type="submit" value="Calculate">

</form>
</body>
</html>
