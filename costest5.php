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

$varnames = array("transportation","distance","distunit","weightlimit","netloadwl","wlunit","transportinitcost","transportopcost","fueltype","fueleff","loadtime","avgvel","pg5complete");

for ($k=0;$k<count($varnames);$k++) {
	if ($_SESSION[$varnames[$k]]!='') {
		${$varnames[$k]} = $_SESSION[$varnames[$k]];
	} else {
	${$varnames[$k]} = '';
	}
}

$_SESSION["pg5complete"] = "yes";

//$transportation = $distance = $distunit = $netloadwl = $wlunit = $transportinitcost = $transportopcost = $fueltype = $fueleff = $loadtime = $avgvel = '';
$transportationerror = $distanceerror = $weightlimiterror = $netloadwlerror = $transportinitcosterror = $transportopcosterror = $fuelefferror = $loadtimeerror = $avgvelerror = '';
$transportationmsg = $distancemsg = $weightlimitmsg = $netloadwlmsg = $transportinitcostmsg = $transportopcostmsg = $fueleffmsg = $loadtimemsg = $avgvelmsg = '';

// detect form field errors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if ($_POST["transportation"]=='') {
	if(!isset($_POST["transportation"])) {
	$transportation = '';
  $transportationerror = "*";
  $transportationmsg = "Please choose a transportation type.";
  $_SESSION["transportation"] = '';
  } else { 
  $transportation = test_input($_POST["transportation"]);
  $_SESSION["transportation"] = $transportation;
  }
  
  if ($transportation == 'TractorTrailer') {
	$fueltype = test_input($_POST['fueltype']);
	$_SESSION["fueltype"] = $fueltype;
  
  
  if (($_POST['distance'])=='') {
  $distanceerror = '* ';
  $distancemsg = 'Please enter a value.';
  $_SESSION["distance"] = '';
  } else if (!is_numeric($_POST['distance'])) {
	$distanceerror = "* ";
	$distancemsg = "Please use numeric or decimal characters.";
	$_SESSION["distance"] = '';
  } else if (($_POST["distance"]) < 0 || ($_POST["distance"]) > 100) {
	$distanceerror = "* ";
	$distancemsg = "Value must be between 0 and 100.";
	$_SESSION["distance"] = '';
  } else { 
  $distance = test_input($_POST['distance']);
  $distunit = test_input($_POST['distunit']);
  $_SESSION["distance"] = $distance;
  $_SESSION["distunit"] = $distunit;
  }

  if (!isset($_POST["weightlimit"])) {
  $weightlimiterror = "*";
  $weightlimitmsg = "Please choose an option.";
  $_SESSION["weightlimit"] = '';
  } else if(isset($_POST["weightlimit"])) { 
  $weightlimit = test_input($_POST["weightlimit"]);
  $_SESSION["weightlimit"] = $weightlimit;
  if ($_POST["weightlimit"]!="custom") {
	  $netloadwl = '';
	  $_SESSION["netloadwl"] = $netloadwl;
  } else if ($_POST["weightlimit"]=="custom") {
  if (($_POST['netloadwl'])=='') {
  $netloadwlerror = '* ';
  $netloadwlmsg = 'Please enter a value.';
  $_SESSION["netloadwl"] = $netloadwl;
  } else if (!is_numeric($_POST['netloadwl'])) {
	$netloadwlerror = "* ";
	$netloadwlmsg = "Please use numeric or decimal characters.";
	$_SESSION["netloadwl"] = $netloadwl;
  } else if (($_POST["netloadwl"]) < 0 || ($_POST["netloadwl"]) > 27215) {
	$netloadwlerror = "* ";
	$netloadwlmsg = "Value must be between 0 and 27215.";
	$_SESSION["netloadwl"] = $netloadwl;
  } else { 
  $netloadwl = test_input($_POST['netloadwl']);
  $wlunit = test_input($_POST['wlunit']);
  $_SESSION["netloadwl"] = $netloadwl;
  $_SESSION["wlunit"] = $wlunit;
  }
  }
  }
  
  if (($_POST['transportinitcost'])=='') {
  $transportinitcosterror = '* ';
  $transportinitcostmsg = 'Please enter a value.';
  $_SESSION["transportinitcost"] = '';
  } else if (!is_numeric($_POST['transportinitcost'])) {
	$transportinitcosterror = "* ";
	$transportinitcostmsg = "Please use numeric or decimal characters.";
	$_SESSION["transportinitcost"] = '';
  } else if (($_POST["transportinitcost"]) < 0 || ($_POST["transportinitcost"]) > 1000000000) {
	$transportinitcosterror = "* ";
	$transportinitcostmsg = "Value must be between 0 and 1,000,000,000.";
	$_SESSION["transportinitcost"] = '';
  } else { 
  $transportinitcost = test_input($_POST['transportinitcost']);
  $_SESSION["transportinitcost"] = $transportinitcost;
  }
  
  if (($_POST['transportopcost'])=='') {
  $transportopcosterror = '* ';
  $transportopcostmsg = 'Please enter a value.';
  $_SESSION["transportopcost"] = '';
  } else if (!is_numeric($_POST['transportopcost'])) {
	$transportopcosterror = "* ";
	$transportopcostmsg = "Please use numeric or decimal characters.";
	$_SESSION["transportopcost"] = '';
  } else if (($_POST["transportopcost"]) < 0 || ($_POST["transportopcost"]) > 100000) {
	$transportopcosterror = "* ";
	$transportopcostmsg = "Value must be between 0 and 100,000.";
	$_SESSION["transportopcost"] = '';
  } else { 
  $transportopcost = test_input($_POST['transportopcost']);
  $_SESSION["transportopcost"] = $transportopcost;
  }
  
  if (($_POST['fueleff'])=='') {
  $fuelefferror = '* ';
  $fueleffmsg = 'Please enter a value.';
  $_SESSION["fueleff"] = '';
  } else if (!is_numeric($_POST['fueleff'])) {
	$fuelefferror = "* ";
	$fueleffmsg = "Please use numeric or decimal characters.";
	$_SESSION["fueleff"] = '';
  } else if (($_POST["fueleff"]) < 0 || ($_POST["fueleff"]) > 100) {
	$fuelefferror = "* ";
	$fueleffmsg = "Value must be between 0 and 100.";
	$_SESSION["fueleff"] = '';
  } else { 
  $fueleff = test_input($_POST['fueleff']);
  $_SESSION["fueleff"] = $fueleff;
  }
  
  if (($_POST['loadtime'])=='') {
  $loadtimeerror = '* ';
  $loadtimemsg = 'Please enter a value.';
  $_SESSION["loadtime"] = '';
  } else if (!is_numeric($_POST['loadtime'])) {
	$loadtimeerror = "* ";
	$loadtimemsg = "Please use numeric or decimal characters.";
	$_SESSION["loadtime"] = '';
  } else if (($_POST["loadtime"]) < 0 || ($_POST["loadtime"]) > 10) {
	$loadtimeerror = "* ";
	$loadtimemsg = "Value must be between 0 and 10.";
	$_SESSION["loadtime"] = '';
  } else { 
  $loadtime = test_input($_POST['loadtime']);
  $_SESSION["loadtime"] = $loadtime;
  }
  
  if (($_POST['avgvel'])=='') {
  $avgvelerror = '* ';
  $avgvelmsg = 'Please enter a value.';
  $_SESSION["avgvel"] = '';
  } else if (!is_numeric($_POST['avgvel'])) {
	$avgvelerror = "* ";
	$avgvelmsg = "Please use numeric or decimal characters.";
	$_SESSION["avgvel"] = '';
  } else if (($_POST["avgvel"]) < 0 || ($_POST["avgvel"]) > 100) {
	$avgvelerror = "* ";
	$avgvelmsg = "Value must be between 0 and 100.";
	$_SESSION["avgvel"] = '';
  } else { 
  $avgvel = test_input($_POST['avgvel']);
  $_SESSION["avgvel"] = $avgvel;
  }
  
  if ($_SESSION["transportation"] !='' && $_SESSION["distance"] !='' && $_SESSION["weightlimit"] !='' && $_SESSION["transportinitcost"] !='' && $_SESSION["transportopcost"] !='' && $_SESSION["fueltype"] !='' && $_SESSION["loadtime"] !='' && $_SESSION["avgvel"] != '') {
	  if ($_SESSION["weightlimit"]=="custom" && $_SESSION["netloadwl"] !='') {
	  $_SESSION["pg5complete"] = "yes";
	  header('Location: costest6.php');
	  exit;
	  } else if($_SESSION["weightlimit"]!="custom") {
	  header('Location: costest6.php');
	  exit; 
	  }
  }
  }
  
  if ($_SESSION["transportation"] == 'pipeline' || $_SESSION["transportation"] == 'railway') {
	  if($transportation !='') {
		$_SESSION["distance"] = $distance;
		$_SESSION["distunit"] = $distunit;
		$_SESSION["weightlimit"] = $weightlimit;
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
	document.transport.weightlimit.value='';
	document.getElementById('netloadwl').value='';
	document.getElementById('wlunit').value='';
	document.getElementById('transportinitcost').value='';
	document.getElementById('transportopcost').value='';
	document.getElementById('fueltype').value='';
	document.getElementById('fueleff').value='';
	document.getElementById('loadtime').value='';
	document.getElementById('avgvel').value='';
	document.getElementById('velunit').value='';
	} else if(document.getElementById('TractorTrailer').checked) {
	document.getElementById('truckfields').hidden=false;
	}
}

function defaults() {
	document.getElementById('truckfields').hidden=false;
	document.getElementById('TractorTrailer').checked=true;
	document.getElementById('distance').value = 10;
	document.getElementById('distunit').value = "mi";
	document.getElementById('custom').checked = true;
	document.getElementById('netloadwl').value = 27215;
	document.getElementById('wlunit').value = "kg";
	document.getElementById('transportinitcost').value = 0;
	document.getElementById('transportopcost').value = 52;
	document.getElementById('fueltype').value = "Diesel";
	document.getElementById('fueleff').value = 5;
	document.getElementById('loadtime').value = 0.17;
	document.getElementById('avgvel').value = 40;
	document.getElementById('velunit').value = "mph";
}

function cboxchecker() {
	
var transport = <?php echo json_encode($_SESSION["transportation"]) ?>;
var weightlimit = <?php echo json_encode($_SESSION["weightlimit"]) ?>;

if(transport == "TractorTrailer") {
	document.getElementById('TractorTrailer').checked=true;
	if(weightlimit == "60klbmtrailer") {
		document.getElementById('60klbmtrailer').checked=true;
	}
	if(weightlimit == "60klbmtanker") {
		document.getElementById('60klbmtanker').checked=true;
	}
	if(weightlimit == "custom") {
		document.getElementById('custom').checked=true;
	}
}
if(transport == "pipeline") {
	document.getElementById('pipeline').checked=true;
}
if(transport == "railway") {
	document.getElementById('railway').checked=true;
}
}

function sidebarlinks() {
	var pg1 = <?php echo json_encode($_SESSION["pg1complete"]) ?>;
	var pg2 = <?php echo json_encode($_SESSION["pg2complete"]) ?>;
	var pg3 = <?php echo json_encode($_SESSION["pg3complete"]) ?>;
	var pg4 = <?php echo json_encode($_SESSION["pg4complete"]) ?>;
	var pg5 = <?php echo json_encode($_SESSION["pg5complete"]) ?>;
	var pg6 = <?php echo json_encode($_SESSION["pg6complete"]) ?>;
	
	if(pg1!='') {
		document.getElementById('pg1link').innerHTML = "<a href='costest1.php'>Geothermal Site Info</a>";
	}
	if(pg2!='') {
		document.getElementById('pg2link').innerHTML = "<a href='costest2.php'>Building Site Info</a>";
	}
	if(pg3!='') {
		document.getElementById('pg3link').innerHTML = "<a href='costest3.php'>Baseline System Info</a>";
	}
	if(pg4!='') {
		document.getElementById('pg4link').innerHTML = "<a href='costest4.php'>Choose Technology</a>";
	}
	if(pg6!='') {
		document.getElementById('pg6link').innerHTML = "<a href='costest6.php'>Project Info</a>";
	}
}

function start() {
	sidebarlinks();
	cboxchecker();
	hidefields();
	
}

window.onload = start;
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
<span id="pg1link">Geothermal Site Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg2link">Building Site Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg3link">Baseline System Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg4link">Choose Technology</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Transportation Info</b><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg6link">Project Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Results
</div>


<form class = "input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="transport">
<div class="parabox">
Transportation type: <br/>
<span class = "error"><?php echo $transportationerror;?></span><input type="radio" name="transportation" onclick="hidefields()" value="TractorTrailer" id="TractorTrailer" <?php if (isset($_POST['transportation']) && $_POST['transportation'] == 'TractorTrailer') echo 'checked = "checked"';?>> truck 
<span class = "error"><?php echo $transportationerror;?></span><input type="radio" name="transportation" onclick="hidefields()" value="pipeline" id="pipeline" <?php if (isset($_POST['transportation']) && $_POST['transportation'] == 'pipeline') echo 'checked = "checked"';?>> pipeline 
<span class = "error"><?php echo $transportationerror;?></span><input type="radio" name="transportation" onclick="hidefields()" value="railway" id="railway" <?php if (isset($_POST['transportation']) && $_POST['transportation'] == 'railway') echo 'checked = "checked"';?>> railway
<br /><span class = "error"><?php echo $transportationmsg;?></span>
</div>
<div id="truckfields" hidden><br />
<span class = "error"><?php echo $distanceerror;?></span>Distance: <input type="text" name="distance" id="distance" size="10" value="<?php echo $_SESSION["distance"];?>">
<select name="distunit" id="distunit">
	<option value="mi" <?php if($distunit=="mi") echo "selected='selected'";?>>mi</option>
	<option value="km" <?php if($distunit=="km") echo "selected='selected'";?>>km</option>
	</select>
<br /><span class = "error"><?php echo $distancemsg;?></span>
<br />
<div class="parabox">
<span class = "error"><?php echo $weightlimiterror;?></span>
Net Load Weight Limit: <br/>
<input type="radio" name="weightlimit" value="60klbmtrailer" id="60klbmtrailer" <?php if(isset($_POST["weightlimit"]) && $_POST["weightlimit"]=="60klbmtrailer") echo "selected='selected'";?>> 60 klbm Trailer
<input type="radio" name="weightlimit" value="60klbmtanker" id="60klbmtanker" <?php if(isset($_POST["weightlimit"]) && $_POST["weightlimit"]=="60klbmtanker") echo "selected='selected'";?>> 60 klbm Tanker
<span class = "error"><?php echo $netloadwlerror;?></span><input type="radio" name="weightlimit" value="custom" id="custom" <?php if(isset($_POST["weightlimit"]) && $_POST["weightlimit"]=="custom") echo "selected='selected'";?>> Custom
<input type="text" name="netloadwl" id="netloadwl" size="10" value="<?php echo $_SESSION["netloadwl"];?>">
<select name="wlunit" id="wlunit">
	<option value="lbm" <?php if($wlunit=="lbm") echo "selected='selected'";?>>lbm</option>
	<option value="kg" <?php if($wlunit=="kg") echo "selected='selected'";?>>kg</option>
	</select>
<br /><span class = "error"><span class = "error"><?php echo $weightlimitmsg;?></span><?php echo $netloadwlmsg;?></span></div>
<br />
<span class = "error"><?php echo $transportinitcosterror;?></span>Initial Cost: $<input type="text" name="transportinitcost" id="transportinitcost" size="10" value="<?php echo $_SESSION["transportinitcost"];?>">
<br /><span class = "error"><?php echo $transportinitcostmsg;?></span>
<br />
<span class = "error"><?php echo $transportopcosterror;?></span>Operating Cost: $<input type="text" name="transportopcost" id="transportopcost" size="10" value="<?php echo $_SESSION["transportopcost"];?>">/hr
<!--<select name="unit" id="unit">
	<option value="unit1">Unit 1</option>
	<option value="unit2">Unit 2</option>
	<option value="unit3">Unit 3</option>
	</select>-->
<br /><span class = "error"><?php echo $transportopcostmsg;?></span>
<br />
Fuel Type: <select name="fueltype" id="fueltype">
	<option value="Diesel" <?php if($fueltype=="Diesel") echo "selected='selected'";?>>Diesel</option>
	<option value="Gasoline" <?php if($fueltype=="Gasoline") echo "selected='selected'";?>>Gasoline</option>
	</select>
<br />
<br />
<span class = "error"><?php echo $fuelefferror;?></span>Fuel Efficiency: <input type="text" name="fueleff" id="fueleff" size="10" value="<?php echo $_SESSION["fueleff"];?>"> mpg
<br /><span class = "error"><?php echo $fueleffmsg;?></span>
<br />
<span class = "error"><?php echo $loadtimeerror;?></span>Loading Time: <input type="text" name="loadtime" id="loadtime" size="10" value="<?php echo $_SESSION["loadtime"];?>">/hr
<!--<select name="unit" id="unit">
	<option value="unit1">Unit 1</option>
	<option value="unit2">Unit 2</option>
	<option value="unit3">Unit 3</option>
	</select>-->
<br /><span class = "error"><?php echo $loadtimemsg;?></span>
<br />
<span class = "error"><?php echo $avgvelerror;?></span>Average Velocity: <input type="text" name="avgvel" id="avgvel" size="10" value="<?php echo $_SESSION["avgvel"];?>">/<select name="velunit" id="velunit">
	<option value="mph">mph</option>
	<option value="km/h">km/h</option>
	</select>
<br /><span class = "error"><?php echo $avgvelmsg;?></span></div>
<br />
<button type="button" onclick="defaults()">Use Default Values</button>
<br/>
<br/>
<input type="button" value="Start Over" onclick="location.href='begin.php'"><input type="button" value="Previous" onclick="location.href='costest4.php'">
<input type="submit" value="Save and Continue">

</form>
</body>
</html>
