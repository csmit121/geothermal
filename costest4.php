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


$varnames = array("DUHselect","DUCselect","ADSselect","TSGAselect","CTSGAselect","ICEselect","SSLCselect","pg4complete");

for ($k=0;$k<count($varnames);$k++) {
	if ($_SESSION[$varnames[$k]]!='') {
		${$varnames[$k]} = $_SESSION[$varnames[$k]];
	} else {
	${$varnames[$k]} = '';
	}
}

$techselecterror = $boxerror = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$_SESSION["pg4complete"]='';
  if (isset($_POST['DUHbox'])) {
  	$DUHselect = "DUH";
  }
  else {
	$DUHselect = '';
	}
  $_SESSION["DUHselect"] = $DUHselect;


  if (isset($_POST['DUCbox'])) {
  	$DUCselect = "DUC";
  }
  else {
	$DUCselect = '';
	}
  $_SESSION["DUCselect"] = $DUCselect;

 
  if (isset($_POST['ADSbox'])) {
  	$ADSselect = "ADS";
  }
  else {
	$ADSselect = '';
	}
  $_SESSION["ADSselect"] = $ADSselect;

  
  if (isset($_POST['TSGAbox'])) {
  	$TSGAselect = "TSGA";
  }
  else {
	$TSGAselect = '';
	}
  $_SESSION["TSGAselect"] = $TSGAselect;

  
  if (isset($_POST['CTSGAbox'])) {
  	$CTSGAselect = "CTSGA";
  }
  else {
	$CTSGAselect = '';
	}
  $_SESSION["CTSGAselect"] = $CTSGAselect;

  
  if (isset($_POST['ICEbox'])) {
  	$ICEselect = "ICE";
  }
  else {
	$ICEselect = '';
	}
  $_SESSION["ICEselect"] = $ICEselect;

  
  if (isset($_POST['SSLCbox'])) {
  	$SSLCselect = "SSLC";
  }
  else {
	$SSLCselect = '';
	}
  $_SESSION["SSLCselect"] = $SSLCselect;
  
  if(!isset($_POST['DUHbox']) && !isset($_POST['DUCbox']) && !isset($_POST['ADSbox']) && !isset($_POST['TSGAbox']) && !isset($_POST['CTSGAbox']) && !isset($_POST['ICEbox']) && !isset($_POST['SSLCbox'])) {
	$techselecterror = 'please select at least one technology';
	$boxerror = '* ';
  }
  else if(isset($_POST['DUHbox']) || isset($_POST['DUCbox']) || isset($_POST['ADSbox']) || isset($_POST['TSGAbox']) || isset($_POST['CTSGAbox']) || isset($_POST['ICEbox']) || isset($_POST['SSLCbox']))
  {
	$_SESSION["pg4complete"] = "yes";
	header('Location: costest5.php');
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

<script language="JavaScript">
function hidetabs() {
	var geofluidt = "<?php echo $fluidt;?>";
	if (geofluidt > 100 && geofluidt <=150) {
		if ("<?php echo $cool_peak_load;?>"!='' && "<?php echo $heat_peak_load;?>"!='') {
			document.getElementById('DUHtab').hidden=true;
			document.getElementById('DUHlist').hidden=true;
			document.getElementById('DUCtab').hidden=true;
			document.getElementById('DUClist').hidden=true;
			document.getElementById('TSGAtab').hidden=true;
			document.getElementById('TSGAlist').hidden=true;
			document.getElementById('CTSGAtab').hidden=true;
			document.getElementById('CTSGAlist').hidden=true;
			document.getElementById('ICEtab').hidden=true;
			document.getElementById('ICElist').hidden=true;
			document.getElementById('SSLCtab').hidden=true;
			document.getElementById('SSLClist').hidden=true;
			document.getElementById('ADSbox').checked=true;
			document.getElementById('ADSbox').readonly=true;
		}
		else if ("<?php echo $heat_peak_load;?>"!='') {
			document.getElementById('DUCtab').hidden=true;
			document.getElementById('DUClist').hidden=true;
			document.getElementById('TSGAtab').hidden=true;
			document.getElementById('TSGAlist').hidden=true;
			document.getElementById('ICEtab').hidden=true;
			document.getElementById('ICElist').hidden=true;
			document.getElementById('SSLCtab').hidden=true;
			document.getElementById('SSLClist').hidden=true;
		}
		else if ("<?php echo $cool_peak_load;?>"!='') {
			document.getElementById('DUHtab').hidden=true;
			document.getElementById('DUHlist').hidden=true;
		}
	}
	else if (geofluidt > 85 && geofluidt <=100) {
		if ("<?php echo $cool_peak_load;?>"!='' && "<?php echo $heat_peak_load;?>"!='') {
			document.getElementById('DUHtab').hidden=true;
			document.getElementById('DUHlist').hidden=true;
			document.getElementById('DUCtab').hidden=true;
			document.getElementById('DUClist').hidden=true;
			document.getElementById('TSGAtab').hidden=true;
			document.getElementById('TSGAlist').hidden=true;
			document.getElementById('CTSGAtab').hidden=true;
			document.getElementById('CTSGAlist').hidden=true;
			document.getElementById('ICEtab').hidden=true;
			document.getElementById('ICElist').hidden=true;
			document.getElementById('SSLCtab').hidden=true;
			document.getElementById('SSLClist').hidden=true;
			document.getElementById('ADSbox').checked=true;
			document.getElementById('ADSbox').readonly=true;
		}
		else if ("<?php echo $heat_peak_load;?>"!='') {
			document.getElementById('DUCtab').hidden=true;
			document.getElementById('DUClist').hidden=true;
			document.getElementById('TSGAtab').hidden=true;
			document.getElementById('TSGAlist').hidden=true;
			document.getElementById('ICEtab').hidden=true;
			document.getElementById('ICElist').hidden=true;
			document.getElementById('SSLCtab').hidden=true;
			document.getElementById('SSLClist').hidden=true;
		}
		else if ("<?php echo $cool_peak_load;?>"!='') {
			document.getElementById('DUHtab').hidden=true;
			document.getElementById('DUHlist').hidden=true;
			document.getElementById('ICEtab').hidden=true;
			document.getElementById('ICElist').hidden=true;
		}
	}
	else if (geofluidt > 60 && geofluidt <=85) {
		if ("<?php echo $cool_peak_load;?>"!='' && "<?php echo $heat_peak_load;?>"!='') {
			document.getElementById('DUHtab').hidden=true;
			document.getElementById('DUHlist').hidden=true;
			document.getElementById('DUCtab').hidden=true;
			document.getElementById('DUClist').hidden=true;
			document.getElementById('TSGAtab').hidden=true;
			document.getElementById('TSGAlist').hidden=true;
			document.getElementById('CTSGAtab').hidden=true;
			document.getElementById('CTSGAlist').hidden=true;
			document.getElementById('ICEtab').hidden=true;
			document.getElementById('ICElist').hidden=true;
			document.getElementById('SSLCtab').hidden=true;
			document.getElementById('SSLClist').hidden=true;
			document.getElementById('ADSbox').checked=true;
			document.getElementById('ADSbox').readonly=true;
		}
		else if ("<?php echo $heat_peak_load;?>"!='') {
			document.getElementById('DUCtab').hidden=true;
			document.getElementById('DUClist').hidden=true;
			document.getElementById('TSGAtab').hidden=true;
			document.getElementById('TSGAlist').hidden=true;
			document.getElementById('ICEtab').hidden=true;
			document.getElementById('ICElist').hidden=true;
			document.getElementById('SSLCtab').hidden=true;
			document.getElementById('SSLClist').hidden=true;
		}
		else if ("<?php echo $cool_peak_load;?>"!='') {
			document.getElementById('DUHtab').hidden=true;
			document.getElementById('DUHlist').hidden=true;
			document.getElementById('DUCtab').hidden=true;
			document.getElementById('DUClist').hidden=true;
			document.getElementById('TSGAtab').hidden=true;
			document.getElementById('TSGAlist').hidden=true;
			document.getElementById('ICEtab').hidden=true;
			document.getElementById('ICElist').hidden=true;
		}
	}
	
	
}

function cboxchecker() {
	
var duh = <?php echo json_encode($_SESSION["DUHselect"]) ?>;
var duc = <?php echo json_encode($_SESSION["DUCselect"]) ?>;
var ads = <?php echo json_encode($_SESSION["ADSselect"]) ?>;
var tsga = <?php echo json_encode($_SESSION["TSGAselect"]) ?>;
var ctsga = <?php echo json_encode($_SESSION["CTSGAselect"]) ?>;
var ice = <?php echo json_encode($_SESSION["ICEselect"]) ?>;
var sslc = <?php echo json_encode($_SESSION["SSLCselect"]) ?>;
	
if(duh != '') {
	document.getElementById('DUHbox').checked=true;
}
if(duc != '') {
	document.getElementById('DUCbox').checked=true;
}
if(ads != '') {
	document.getElementById('ADSbox').checked=true;
}
if(tsga != '') {
	document.getElementById('TSGAbox').checked=true;
}
if(ctsga != '') {
	document.getElementById('CTSGAbox').checked=true;
}
if(ice != '') {
	document.getElementById('ICEbox').checked=true;
}
if(sslc != '') {
	document.getElementById('SSLCbox').checked=true;
}
}

function openCity(evt, cityName) {
    var j, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (j = 0; j < tabcontent.length; j++) {
        tabcontent[j].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (j = 0; j < tabcontent.length; j++) {
        tablinks[j].className = tablinks[j].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
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
	if(pg5!='') {
		document.getElementById('pg5link').innerHTML = "<a href='costest5.php'>Transportation Info</a>";
	}
	if(pg6!='') {
		document.getElementById('pg6link').innerHTML = "<a href='costest6.php'>Project Info</a>";
	}
}

function start() {
	sidebarlinks();
	hidetabs();
	cboxchecker();
}

window.onload = start;
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Choose Technology</title>
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
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Choose Technology</b><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg5link">Transportation Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg6link">Project Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Calculate
</div>

<form class="results" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="tech">
<b>Click tabs for technology descriptions.</b>
<br />
<br />
<ul class="tab">
  <li id="DUHtab"><a href="#" class="tablinks" onclick="openCity(event, 'DUH')">DUH</a></li>
  <li id="DUCtab"><a href="#" class="tablinks" onclick="openCity(event, 'DUC')">DUC</a></li>
  <li id="ADStab"><a href="#" class="tablinks" onclick="openCity(event, 'ADS')">ADS</a></li>
  <li id="TSGAtab"><a href="#" class="tablinks" onclick="openCity(event, 'TSGA')">TSGA</a></li>
  <li id="CTSGAtab"><a href="#" class="tablinks" onclick="openCity(event, 'CTSGA')">Crystal-TSGA</a></li>
  <li id="ICEtab"><a href="#" class="tablinks" onclick="openCity(event, 'ICE')">ICE</a></li>
  <li id="SSLCtab"><a href="#" class="tablinks" onclick="openCity(event, 'SSLC')">SSLC</a></li>
  </ul>

<div id="DUH" class="tabcontent">
  <h3>Direct Use Heating</h3>
  <p>Using hot water heated by geothermal fluid to provide heating.</p>
</div>

<div id="DUC" class="tabcontent">
  <h3>Direct Use Cooling</h3>
  <p>Use geothermal driven absorption chiller to produce chilled water.</p> 
</div>

<div id="ADS" class="tabcontent">
  <h3>Closed Loop Adsorption</h3>
  <p>Use geothermal heat to regenerate solid desiccant for closed loop applications.</p>
</div>

<div id="TSGA" class="tabcontent">
  <h3>Closed Loop Absorption</h3>
  <p>Use geothermal heat to regenerate liquid desiccant for closed loop applications.</p>
</div>

<div id="CTSGA" class="tabcontent">
  <h3>Closed Loop Absorption with Crystal</h3>
  <p>Use geothermal heat to regenerate solid desiccant crystal for closed loop applications.</p>
</div>

<div id="ICE" class="tabcontent">
  <h3>Mobile Ice Cooling</h3>
  <p>Use geothermal heat to drive ammonia/water absorption chiller and produce ice for cooling applications.</p>
</div>

<div id="SSLC" class="tabcontent">
  <h3>Separated Sensible and Latent Cooling</h3>
  <p>Use geothermal heat to regenerate liquid/solid/crystal desiccant for open loop latent cooling applications.</p>
</div>
<div class ="parabox">
<h3>Choose technology option(s):</h3>
<div id="DUHlist"><span class="error"><?php echo $boxerror;?></span><input type="checkbox" id="DUHbox" name="DUHbox" value="ON"></input>DUH (Direct Use Heating)</div>
<div id="DUClist"><span class="error"><?php echo $boxerror;?></span><input type="checkbox" id="DUCbox" name="DUCbox" value="ON"></input>DUC (Direct Use Cooling)</div>
<div id="ADSlist"><span class="error"><?php echo $boxerror;?></span><input type="checkbox" id="ADSbox" name="ADSbox" value="ON"></input>ADS (Closed Loop Adsorption)</div>
<div id="TSGAlist"><span class="error"><?php echo $boxerror;?></span><input type="checkbox" id="TSGAbox" name="TSGAbox" value="ON"></input>TSGA (Closed Loop Absorption)</div>
<div id="CTSGAlist"><span class="error"><?php echo $boxerror;?></span><input type="checkbox" id="CTSGAbox" name="CTSGAbox" value="ON"></input>Crystal-TSGA (Closed Loop Absorption with Crystal)</div>
<div id="ICElist"><span class="error"><?php echo $boxerror;?></span><input type="checkbox" id="ICEbox" name="ICEbox" value="ON"></input>ICE (Mobile Ice Cooling)</div>
<div id="SSLClist"><span class="error"><?php echo $boxerror;?></span><input type="checkbox" id="SSLCbox" name="SSLCbox" value="ON"></input>SSLC (Separated Sensible and Latent Cooling)</div>
</div>
<br />
<br />
<input type="button" value="Previous" onclick="location.href='costest3.php'">
<input type="submit" value="Next"> <span class="error"><?php echo $techselecterror;?></span>
</form>

</body>
</html>
