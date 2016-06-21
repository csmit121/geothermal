<?php
session_start();
// pass variables from previous page
$fluidt = $_SESSION["fluidt"];
$siteinvest = $_SESSION["siteinvest"];
$opcost = $_SESSION["opcost"];

$varnames = array("building_location","building_state","selected_bldg_loc","heat_peak_load","heat_total_load","cool_peak_load","cool_total_load","natgas_price","electricity_price","pg2complete");

for ($k=0;$k<count($varnames);$k++) {
	if ($_SESSION[$varnames[$k]]!='') {
		${$varnames[$k]} = $_SESSION[$varnames[$k]];
	} else {
	${$varnames[$k]} = '';
	}
}	

// define variables and set to empty values
$building_locationerror = $heat_peak_loaderror = $heat_total_loaderror = $cool_peak_loaderror = $cool_total_loaderror = $natgas_priceerror = $electricity_priceerror = '';
$building_locationmsg = $heat_peak_loadmsg = $heat_total_loadmsg = $cool_peak_loadmsg = $cool_total_loadmsg = $natgas_pricemsg = $electricity_pricemsg = '';
$cboxerror = $heatapperror = $coolapperror = '';
//$building_location = $building_state = $heat_peak_load = $heat_total_load = $cool_peak_load = $cool_total_load = $natgas_price = $electricity_price = '';
//$selected_bldg_loc = '';

// detect form field errors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$_SESSION["pg2complete"]='';
	$building_state = test_input($_POST["building_state"]);
	$_SESSION["building_state"] = $building_state;
  if ($_POST["building_location"]=='' && $_SESSION["building_location"]=='') {
	$building_locationerror = "* ";
	$building_locationmsg = "Please select a city/region.";
	$_SESSION["building_location"] = '';
	$selected_bldg_loc = '';
	$_SESSION["selected_bldg_loc"] = '';
  } else if($_POST["building_location"]=='' && $_SESSION["building_location"]!=='') {
	$building_location = $_SESSION["building_location"];
	$selected_bldg_loc = "<br/>Selected building location: ".$building_location.", ".$building_state."<br/>";
    $_SESSION["selected_bldg_loc"] = $selected_bldg_loc;
  } else {
  $building_location = test_input($_POST["building_location"]);
  $selected_bldg_loc = "<br/>Selected building location: ".$building_location.", ".$building_state."<br/>";
  $_SESSION["building_location"] = $building_location;
  $_SESSION["selected_bldg_loc"] = $selected_bldg_loc;
  }
  
  if ($_POST["natgas_price"]=='') {
	$natgas_priceerror = "* ";
	$natgas_pricemsg = "Please input a value.";
	$_SESSION["natgas_price"] = '';
  } else if (!is_numeric($_POST["natgas_price"])) {
    $natgas_priceerror = "* ";
	$natgas_pricemsg = "Please use numeric or decimal characters.";
	$_SESSION["natgas_price"] = '';
  } else if (($_POST["natgas_price"]) < 0.01 || ($_POST["natgas_price"]) > 10) {
	$natgas_priceerror = "* ";
	$natgas_pricemsg = "Value must be between 0.01 and 10.";
	$_SESSION["natgas_price"] = '';
  } else {
  $natgas_price = test_input($_POST["natgas_price"]);
  $_SESSION["natgas_price"] = $natgas_price;
  }
  
  if ($_POST["electricity_price"]=='') {
	$electricity_priceerror = "* ";
	$electricity_pricemsg = "Please input a value.";
	$_SESSION["electricity_price"] = '';
  } else if (!is_numeric($_POST["electricity_price"])) {
	$electricity_priceerror = "* ";
	$electricity_pricemsg = "Please use numeric or decimal characters.";
	$_SESSION["electricity_price"] = '';
  } else if (($_POST["electricity_price"]) < 0.01 || ($_POST["electricity_price"]) > 10) {
	$electricity_priceerror = "* ";
	$electricity_pricemsg = "Value must be between 0.01 and 10.";
	$_SESSION["electricity_price"] = '';
  } else {
  $electricity_price = test_input($_POST["electricity_price"]);
  $_SESSION["electricity_price"] = $electricity_price;
  }
  
  if (isset($_POST['heatapp'])) {
	if ($_POST["heat_peak_load"]=='') {
		$heat_peak_loaderror = "* ";
		$heat_peak_loadmsg = "Please input a value.";
		$_SESSION["heat_peak_load"] = '';
	} else if (!is_numeric($_POST["heat_peak_load"])) {
		$heat_peak_loaderror = "* ";
		$heat_peak_loadmsg = "Please use numeric or decimal characters.";
		$_SESSION["heat_peak_load"] = '';
	} else if (($_POST["heat_peak_load"]) < 1 || ($_POST["heat_peak_load"]) > 1000000) {
		$heat_peak_loaderror = "* ";
		$heat_peak_loadmsg = "Value must be between 1 and 1,000,000.";
		$_SESSION["heat_peak_load"] = '';
	} 	else {
	$heat_peak_load = test_input($_POST["heat_peak_load"]);
	$_SESSION["heat_peak_load"] = $heat_peak_load;
	}
	if ($_POST["heat_total_load"]=='') {
		$heat_total_loaderror = "* ";
		$heat_total_loadmsg = "<br/>Please input a value.";
		$_SESSION["heat_total_load"] = '';
	} else if (!is_numeric($_POST["heat_total_load"])) {
		$heat_total_loaderror = "* ";
		$heat_total_loadmsg = "<br/>Please use numeric or decimal characters.";
		$_SESSION["heat_total_load"] = '';
	} else if (($_POST["heat_total_load"]) < 1 || ($_POST["heat_total_load"]) > 1000000000) {
		$heat_total_loaderror = "* ";
		$heat_total_loadmsg = "<br/>Value must be between 1 and 1,000,000,000.";
		$_SESSION["heat_total_load"] = '';
	} 	else {
	$heat_total_load = test_input($_POST["heat_total_load"]);
	$_SESSION["heat_total_load"] = $heat_total_load;
	}
  }	
  
  if (isset($_POST['coolapp'])) {
	if ($_POST["cool_peak_load"]=='') {
		$cool_peak_loaderror = "* ";
		$cool_peak_loadmsg = "Please input a value.";
		$_SESSION["cool_peak_load"] = '';
	} else if (!is_numeric($_POST["cool_peak_load"])) {
		$cool_peak_loaderror = "* ";
		$cool_peak_loadmsg = "Please use numeric or decimal characters.";
		$_SESSION["cool_peak_load"] = '';
	} else if (($_POST["cool_peak_load"]) < 1 || ($_POST["cool_peak_load"]) > 1000000) {
		$cool_peak_loaderror = "* ";
		$cool_peak_loadmsg = "Value must be between 1 and 1,000,000.";
		$_SESSION["cool_peak_load"] = '';
	} 	else {
	$cool_peak_load = test_input($_POST["cool_peak_load"]);
	$_SESSION["cool_peak_load"] = $cool_peak_load;
	}
	if ($_POST["cool_total_load"]=='') {
		$cool_total_loaderror = "* ";
		$cool_total_loadmsg = "<br/>Please input a value.";
		$_SESSION["cool_total_load"] = '';
	} else if (!is_numeric($_POST["cool_total_load"])) {
		$cool_total_loaderror = "* ";
		$cool_total_loadmsg = "<br/>Please use numeric or decimal characters.";
		$_SESSION["cool_total_load"] = '';
	} else if (($_POST["cool_total_load"]) < 1 || ($_POST["cool_total_load"]) > 1000000000) {
		$cool_total_loaderror = "* ";
		$cool_total_loadmsg = "<br/>Value must be between 1 and 1,000,000,000.";
		$_SESSION["cool_total_load"] = '';
	} 	else {
	$cool_total_load = test_input($_POST["cool_total_load"]);
	$_SESSION["cool_total_load"] = $cool_total_load;
	}
  }
  
  if (!isset($_POST['coolapp']) && !isset($_POST['heatapp'])) {
	$cboxerror = 'please select heating and/or cooling application';
	$heatapperror = '* ';
	$coolapperror = '* ';
	$_SESSION["heat_peak_load"] = '';	
	$_SESSION["heat_total_load"] = '';
	$_SESSION["cool_peak_load"] = '';	
	$_SESSION["cool_total_load"] = '';
  }
  else if (isset($_POST['heatapp']) && !isset($_POST['coolapp'])) {
	if ($_SESSION["heat_peak_load"] != '' && $_SESSION["heat_total_load"] != '' && $_SESSION["building_location"] != '' && $_SESSION["natgas_price"] != '' && $_SESSION["electricity_price"] != '') {
    $_SESSION["cool_peak_load"] = '';	
	$_SESSION["cool_total_load"] = '';
	$_SESSION["pg2complete"] = "yes";
	  header('Location: costest3.php');
	  exit;
	}
  }
  else if (!isset($_POST['heatapp']) && isset($_POST['coolapp'])) {
	if ($_SESSION["cool_peak_load"] != '' && $_SESSION["cool_total_load"] != '' && $_SESSION["building_location"] != '' && $_SESSION["natgas_price"] != '' && $_SESSION["electricity_price"] != '') {
    $_SESSION["heat_peak_load"] = '';	
	$_SESSION["heat_total_load"] = '';
	$_SESSION["pg2complete"] = "yes";
	  header('Location: costest3.php');
	  exit;
	}
  }
  else if (isset($_POST['heatapp']) && isset($_POST['coolapp'])) {
	if ($_SESSION["heat_peak_load"] != '' && $_SESSION["heat_total_load"] != '' && $_SESSION["cool_peak_load"] != '' && $_SESSION["cool_total_load"] != '' && $_SESSION["building_location"] != '' && $_SESSION["natgas_price"] != '' && $_SESSION["electricity_price"] != '') {
	  $_SESSION["pg2complete"] = "yes";
	  header('Location: costest3.php');
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

$states = array("AK","AL","AR","AZ","CA","CO","CT","DE","FL","GA","GU","HI","IA","ID","IL",
				"IN","KS","KY","LA","MA","MD","ME","MI","MN","MO","MS","MT","NC","ND","NE",
				"NH","NJ","NM","NV","NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX",
				"UT","VA","VI","VT","WA","WI","WV","WY");
for ($i=0;$i<53;$i++) {
	$cities[$i] = explode(PHP_EOL, file_get_contents("weatherdata/".$states[$i].".txt"));
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- this script allows user to enable heating and/or cooling application fields -->
<SCRIPT LANGUAGE="JavaScript">

var states = <?php echo json_encode($states)?>;
var cities = <?php echo json_encode($cities)?>;

var s = '';
function cityoptions() {
	s = document.getElementById("building_state").value;
	for (var i=0;i<53;i++) {
	if(s==states[i]) {
		var citylist = cities[i];
		var select = document.getElementById("building_location");
		select.options.length = 0;
		var opt = "<option value=''>City/Region</option>";
		select.innerHTML = select.innerHTML + opt;
		for (j=0;j<citylist.length-1;j++) {
			//var opt = "<option id=city"+j+" value="+citylist[j]+">"+citylist[j]+"</option>";
			//select.innerHTML = select.innerHTML + opt;
			var elem = document.createElement("option");
			elem.textContent = citylist[j];
			elem.id = "city"+j;
			elem.value = citylist[j];
			select.appendChild(elem);
		}
		i = 53;
	}
	}
}

function selectdetect() { //this function has not worked
	var bldg_loc = <?php echo json_encode($_SESSION["building_location"]) ?>;
var cit = document.getElementById("building_location");
for (i=0;i<cit.options.length-1;i++) {
	if (document.getElementById('city'+i).value==bldg_loc) {
		document.getElementById('city'+i).selected=true;
	} else {
		document.getElementById('city'+1).selected=true;
	}
}
}



function cboxchecker() {
	
var htpkld = <?php echo json_encode($_SESSION["heat_peak_load"]) ?>;
var clpkld = <?php echo json_encode($_SESSION["cool_peak_load"]) ?>;
	
if(htpkld != '') {
	document.economic.heatapp.checked=true;
}
if(clpkld != '') {
	document.economic.coolapp.checked=true;
}
}

function codename() {

if(document.economic.heatapp.checked && document.economic.coolapp.checked==false)
{
//document.economic.action="costest3h.html";
document.economic.heat_peak_load.disabled=false;
//document.economic.htpkld_unit.disabled=false;
document.economic.heat_total_load.disabled=false;
//document.economic.httold_unit.disabled=false;
//document.economic.httold_time.disabled=false;

document.economic.cool_peak_load.disabled=true;
//document.economic.clpkld_unit.disabled=true;
document.economic.cool_total_load.disabled=true;
//document.economic.cltold_unit.disabled=true;
//document.economic.cltold_time.disabled=true;
}
else if(document.economic.coolapp.checked && document.economic.heatapp.checked==false)
{
//document.economic.action="costest3c.html";
document.economic.heat_peak_load.disabled=true;
//document.economic.htpkld_unit.disabled=true;
document.economic.heat_total_load.disabled=true;
//document.economic.httold_unit.disabled=true;
//document.economic.httold_time.disabled=true;

document.economic.cool_peak_load.disabled=false;
//document.economic.clpkld_unit.disabled=false;
document.economic.cool_total_load.disabled=false;
//document.economic.cltold_unit.disabled=false;
//document.economic.cltold_time.disabled=false;
}
else if(document.economic.heatapp.checked && document.economic.coolapp.checked)
{
//document.economic.action="costest3hc.html";
document.economic.heat_peak_load.disabled=false;
//document.economic.htpkld_unit.disabled=false;
document.economic.heat_total_load.disabled=false;
//document.economic.httold_unit.disabled=false;
//document.economic.httold_time.disabled=false;

document.economic.cool_peak_load.disabled=false;
//document.economic.clpkld_unit.disabled=false;
document.economic.cool_total_load.disabled=false;
//document.economic.cltold_unit.disabled=false;
//document.economic.cltold_time.disabled=false;
}
else
{
//document.economic.action="costest2.html";
document.economic.heat_peak_load.disabled=true;
//document.economic.htpkld_unit.disabled=true;
document.economic.heat_total_load.disabled=true;
//document.economic.httold_unit.disabled=true;
//document.economic.httold_time.disabled=true;

document.economic.cool_peak_load.disabled=true;
//document.economic.clpkld_unit.disabled=true;
document.economic.cool_total_load.disabled=true;
//document.economic.cltold_unit.disabled=true;
//document.economic.cltold_time.disabled=true;
}
}

function defaults() {
		document.getElementById('building_state').value = "TX";
		cityoptions();
		document.getElementById("city"+31).selected = true;
		var showcity = document.getElementById("city"+31).value;
		document.getElementById('natgas_price').value = 0.4;
		document.getElementById('electricity_price').value = 0.102;
		//if(document.economic.heatapp.checked && document.economic.coolapp.checked) {
		//document.getElementById('heat_peak_load').value = 1000;
		//document.getElementById('heat_total_load').value = 10000;
		//document.getElementById('cool_peak_load').value = 3000;
		//document.getElementById('cool_total_load').value = 6767238;
		//} else if(document.economic.heatapp.checked && document.economic.coolapp.checked==false) {
		//document.getElementById('heat_peak_load').value = 1000;
		//document.getElementById('heat_total_load').value = 10000;
		//document.getElementById('cool_peak_load').value = '';
		//document.getElementById('cool_total_load').value = '';
		//} 
		//else if(document.economic.heatapp.checked==false && document.economic.coolapp.checked) {
		document.getElementById("cbox1").checked=false;
		document.getElementById("cbox2").checked=true;
		codename();
		document.getElementById('heat_peak_load').value = '';
		document.getElementById('heat_total_load').value = '';
		document.getElementById('cool_peak_load').value = 3000;
		document.getElementById('cool_total_load').value = 6767238;
		//}
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
	if(pg3!='') {
		document.getElementById('pg3link').innerHTML = "<a href='costest3.php'>Baseline System Info</a>";
	}
	if(pg4!='') {
		document.getElementById('pg4link').innerHTML = "<a href='costest4.php'>Choose Technology</a>";
	}
	if(pg5!='') {
		document.getElementById('pg5link').innerHTML = "<a href='costest5.php'>Transportation Info</a>";
	}
	if(pg6!='') {
		document.getElementById('pg6link').innerHTML = "<a href='costest6.php'>Project Info</a>";
	}
}

function start() {
	sidebarlinks();
	cityoptions();
	cboxchecker();
	//selectdetect();
	codename();
}

window.onload = start;
</SCRIPT>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Building Site Info</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!-- header -->
<div class="headerbar">
</div>

<!-- progress bar -->
<div class="progresslabels">
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg1link">Geothermal Site Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Building Site Info</b><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg3link">Baseline System Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg4link">Choose Technology</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg5link">Transportation Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg6link">Project Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Calculate
</div>

<!-- form -->
<form class="input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="economic" id="economic">
<span class="error"><?php echo $building_locationerror;?></span>Building location:
<select name="building_state" id="building_state" onchange="cityoptions()">
	<option value="AL" <?php if($building_state=="AL") echo "selected='selected'";?>>Alabama</option>
	<option value="AK" <?php if($building_state=="AK") echo "selected='selected'";?>>Alaska</option>
	<option value="AZ" <?php if($building_state=="AZ") echo "selected='selected'";?>>Arizona</option>
	<option value="AR" <?php if($building_state=="AR") echo "selected='selected'";?>>Arkansas</option>
	<option value="CA" <?php if($building_state=="CA") echo "selected='selected'";?>>California</option>
	<option value="CO" <?php if($building_state=="CO") echo "selected='selected'";?>>Colorado</option>
	<option value="CT" <?php if($building_state=="CT") echo "selected='selected'";?>>Connecticut</option>
	<option value="DE" <?php if($building_state=="DE") echo "selected='selected'";?>>Delaware</option>
	<option value="FL" <?php if($building_state=="FL") echo "selected='selected'";?>>Florida</option>
	<option value="GA" <?php if($building_state=="GA") echo "selected='selected'";?>>Georgia</option>
	<option value="GU" <?php if($building_state=="GU") echo "selected='selected'";?>>Guam</option>
	<option value="HI" <?php if($building_state=="HI") echo "selected='selected'";?>>Hawaii</option>
	<option value="ID" <?php if($building_state=="ID") echo "selected='selected'";?>>Idaho</option>
	<option value="IL" <?php if($building_state=="IL") echo "selected='selected'";?>>Illinois</option>
	<option value="IN" <?php if($building_state=="IN") echo "selected='selected'";?>>Indiana</option>
	<option value="IA" <?php if($building_state=="IA") echo "selected='selected'";?>>Iowa</option>
	<option value="KS" <?php if($building_state=="KS") echo "selected='selected'";?>>Kansas</option>
	<option value="KY" <?php if($building_state=="KY") echo "selected='selected'";?>>Kentucky</option>
	<option value="LA" <?php if($building_state=="LA") echo "selected='selected'";?>>Louisiana</option>
	<option value="ME" <?php if($building_state=="ME") echo "selected='selected'";?>>Maine</option>
	<option value="MD" <?php if($building_state=="MD") echo "selected='selected'";?>>Maryland</option>
	<option value="MA" <?php if($building_state=="MA") echo "selected='selected'";?>>Massachusetts</option>
	<option value="MI" <?php if($building_state=="MI") echo "selected='selected'";?>>Michigan</option>
	<option value="MN" <?php if($building_state=="MN") echo "selected='selected'";?>>Minnesota</option>
	<option value="MS" <?php if($building_state=="MS") echo "selected='selected'";?>>Mississippi</option>
	<option value="MO" <?php if($building_state=="MO") echo "selected='selected'";?>>Missouri</option>
	<option value="MT" <?php if($building_state=="MT") echo "selected='selected'";?>>Montana</option>
	<option value="NE" <?php if($building_state=="NE") echo "selected='selected'";?>>Nebraska</option>
	<option value="NV" <?php if($building_state=="NV") echo "selected='selected'";?>>Nevada</option>
	<option value="NH" <?php if($building_state=="NH") echo "selected='selected'";?>>New Hampshire</option>
	<option value="NJ" <?php if($building_state=="NJ") echo "selected='selected'";?>>New Jersey</option>
	<option value="NM" <?php if($building_state=="NM") echo "selected='selected'";?>>New Mexico</option>
	<option value="NY" <?php if($building_state=="NY") echo "selected='selected'";?>>New York</option>
	<option value="NC" <?php if($building_state=="NC") echo "selected='selected'";?>>North Carolina</option>
	<option value="ND" <?php if($building_state=="ND") echo "selected='selected'";?>>North Dakota</option>
	<option value="OH" <?php if($building_state=="OH") echo "selected='selected'";?>>Ohio</option>
	<option value="OK" <?php if($building_state=="OK") echo "selected='selected'";?>>Oklahoma</option>
	<option value="OR" <?php if($building_state=="OR") echo "selected='selected'";?>>Oregon</option>
	<option value="PA" <?php if($building_state=="PA") echo "selected='selected'";?>>Pennsylvania</option>
	<option value="PR" <?php if($building_state=="PR") echo "selected='selected'";?>>Puerto Rico</option>
	<option value="RI" <?php if($building_state=="RI") echo "selected='selected'";?>>Rhode Island</option>
	<option value="SC" <?php if($building_state=="SC") echo "selected='selected'";?>>South Carolina</option>
	<option value="SD" <?php if($building_state=="SD") echo "selected='selected'";?>>South Dakota</option>
	<option value="TN" <?php if($building_state=="TN") echo "selected='selected'";?>>Tennessee</option>
	<option value="TX" <?php if($building_state=="TX") echo "selected='selected'";?>>Texas</option>
	<option value="UT" <?php if($building_state=="UT") echo "selected='selected'";?>>Utah</option>
	<option value="VT" <?php if($building_state=="VT") echo "selected='selected'";?>>Vermont</option>
	<option value="VA" <?php if($building_state=="VA") echo "selected='selected'";?>>Virginia</option>
	<option value="VI" <?php if($building_state=="VI") echo "selected='selected'";?>>Virgin Islands</option>
	<option value="WA" <?php if($building_state=="WA") echo "selected='selected'";?>>Washington</option>
	<option value="WV" <?php if($building_state=="WV") echo "selected='selected'";?>>West Virginia</option>
	<option value="WI" <?php if($building_state=="WI") echo "selected='selected'";?>>Wisconsin</option>
	<option value="WY" <?php if($building_state=="WY") echo "selected='selected'";?>>Wyoming</option>
</select>

<select name="building_location" id="building_location"></select>

<!--<input type="text" name="building_location" id="building_location" size="10" value="<?php echo $building_location;?>">-->

<br><span class="error"><?php echo $building_locationmsg;?></span><span><?php echo $_SESSION["selected_bldg_loc"];?></span>
<br>
<div class = "parabox">
<span class="error"><?php echo $heatapperror;?></span><label><input type="checkbox" onclick="codename()" id="cbox1" name="heatapp" value="ON" <?php if(isset($_POST['heatapp'])) echo "checked='checked'";?>>Heating application</label>
<br>
<br>
	<span class="error"><?php echo $heat_peak_loaderror;?></span>Heating peak load:
	<input type="text" name="heat_peak_load" id="heat_peak_load" size="10" value="<?php echo $_SESSION["heat_peak_load"];?>" disabled> kW
	<!--<select name="htpkld_unit" disabled>
	<option value="kW">kW</option>
	<option value="Btuh">Btu/hr</option>
	<option value="hp">hp</option>
	</select>-->
<br><span class="error"><?php echo $heat_peak_loadmsg;?></span>
<br>
	<span class="error"><?php echo $heat_total_loaderror;?></span>Annual heating total load:
	<input type="text" name="heat_total_load" id="heat_total_load" size="10" value="<?php echo $_SESSION["heat_total_load"];?>" disabled> kWh
	<!--<select name="httold_unit" disabled>
	<option value="kWh">kWh</option>
	<option value="MMBtu">MMBtu</option>
	<option value="hph">hph</option>
	</select>/
	<select name="httold_time" disabled>
	<option value="day">Day</option>
	<option value="month">Month</option>
	<option value="year">Year</option>
	</select>--><span class="error"><?php echo $heat_total_loadmsg;?></span>
</div>
<br>
<div class = "parabox">
<span class="error"><?php echo $coolapperror;?></span><label><input type="checkbox" onclick="codename()" id="cbox2" name="coolapp" value="ON" <?php if(isset($_POST['coolapp'])) echo "checked='checked'";?>>Cooling application</label>
<br>
<br>
	<span class="error"><?php echo $cool_peak_loaderror;?></span>Cooling peak load:
	<input type="text" name="cool_peak_load" id="cool_peak_load" size="10" value="<?php echo $_SESSION["cool_peak_load"];?>" disabled> kW
	<!--<select name="clpkld_unit" disabled>
	<option value="kW">kW</option>
	<option value="Btuh">BTU/hr</option>
	<option value="hp">hp</option>
	</select>-->
<br><span class="error"><?php echo $cool_peak_loadmsg;?></span>
<br>
	<span class="error"><?php echo $cool_total_loaderror;?></span>Annual cooling total load:
	<input type="text" name="cool_total_load" id="cool_total_load" size="10" value="<?php echo $_SESSION["cool_total_load"];?>" disabled> kWh
	<!--<select name="cltold_unit" disabled>
	<option value="kWh">kWh</option>
	<option value="MMBtu">MMBtu</option>
	<option value="hph">hph</option>
	</select>/
	<select name="cltold_time" disabled>
	<option value="day">Day</option>
	<option value="month">Month</option>
	<option value="year">Year</option>
	</select>--><span class="error"><?php echo $cool_total_loadmsg;?></span>
</div>
<br>
<span class="error"><?php echo $natgas_priceerror;?></span>Natural gas price: $
<input type="text" name="natgas_price" id="natgas_price" size="10" value="<?php echo $_SESSION["natgas_price"];?>">/MMBtu
<!--<select name="unit">
	<option value="kWh">kWh</option>
	<option value="MMBtu">MMBtu</option>
	<option value="hph">hph</option>
</select>-->
<br><span class="error"><?php echo $natgas_pricemsg;?></span>
<br>
<span class="error"><?php echo $electricity_priceerror;?></span>Electricity price: $
<input type="text" name="electricity_price" id="electricity_price" size="10" value="<?php echo $_SESSION["electricity_price"];?>">/kWh
<!--<select name="unit">
	<option value="kWh">kWh</option>
	<option value="MMBtu">MMBtu</option>
	<option value="hph">hph</option>
</select>-->
<br /><span class="error"><?php echo $electricity_pricemsg;?></span>
<br />
  <button type="button" onclick="defaults()">Use Default Values</button>
  <br />
  <br />
<input type="button" value="Previous" onclick="location.href='costest1.php'">
<input type="submit" value="Next"> <span class="error"><?php echo $cboxerror;?></span>

</form>
</body>
</html>
