<?php
session_start();

$_SESSION["fluidt"]='';
$_SESSION["ftunits"]='';
$_SESSION["wetbulbt"]='';
$_SESSION["wetbulbunits"]='';
$_SESSION["siteinvest"]='';
$_SESSION["opcost"]='';
$_SESSION["opcostunits"]='';
$_SESSION["pg1complete"]='';
$_SESSION["building_location"]='';
$_SESSION["building_state"]='';
$_SESSION["selected_bldg_loc"]='';
$_SESSION["heat_peak_load"]='';
$_SESSION["heat_total_load"]='';
$_SESSION["cool_peak_load"]='';
$_SESSION["cool_total_load"]='';
$_SESSION["natgas_price"]='';
$_SESSION["ngunits"]='';
$_SESSION["electricity_price"]='';
$_SESSION["pg2complete"]='';
$_SESSION["boiler_efficiency"]='';
$_SESSION["elechiller_efficiency"]='';
$_SESSION["design_cop"]='';
$_SESSION["avg_cop"]='';
$_SESSION["chlr_elec_con"]='';
$_SESSION["heat_rej_pr"]='';
$_SESSION["heat_rej_ec"]='';
$_SESSION["pump_pwr_ratio"]='';
$_SESSION["pump_elec_con"]='';
$_SESSION["pg3complete"]='';
$_SESSION["DUHselect"]='';
$_SESSION["DUCselect"]='';
$_SESSION["ADSselect"]='';
$_SESSION["TSGAselect"]='';
$_SESSION["CTSGAselect"]='';
$_SESSION["ICEselect"]='';
$_SESSION["SSLCselect"]='';
$_SESSION["pg4complete"]='';
$_SESSION["transportation"]='';
$_SESSION["distance"]='';
$_SESSION["distunit"]='';
$_SESSION["weightlimit"]='';
$_SESSION["netloadwl"]='';
$_SESSION["wlunit"]='';
$_SESSION["transportinitcost"]='';
$_SESSION["transportopcost"]='';
$_SESSION["fueltype"]='';
$_SESSION["fueleff"]='';
$_SESSION["loadtime"]='';
$_SESSION["avgvel"]='';
$_SESSION["pg5complete"]='';
$_SESSION["lifetime"]='';
$_SESSION["discount"]='';
$_SESSION["pg6complete"]='';
$_SESSION["techtypeerror"]='';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome to the ORNL Geothermal Transport Cost Estimator</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<!--// header -->
<div class="headerbar">
</div>

<form class="input">
Welcome to the ORNL Geothermal Cost Estimator. Please click "next" to begin.
<br/>
<br/>
<input type="button" value="Next" onclick="location.href='costest1.php'"></input>
</form>
</body>
</html>