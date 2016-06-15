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

// define variables and set to empty values
$boiler_efficiency = $elechiller_efficiency = $design_cop = $avg_cop = $chlr_elec_con = $heat_rej_pr = $heat_rej_ec = $pump_pwr_ratio = $pump_elec_con = '';
$_SESSION["boiler_efficiency"] = $_SESSION["elechiller_efficiency"] = $_SESSION["design_cop"] = $_SESSION["avg_cop"] = $_SESSION["chlr_elec_con"] = $_SESSION["heat_rej_pr"] = $_SESSION["heat_rej_ec"] = $_SESSION["pump_pwr_ratio"] = $_SESSION["pump_elec_con"] = '';
$boiler_efficiencyerror = $elechiller_efficiencyerror = $design_coperror = $avg_coperror = $chlr_elec_conerror = $heat_rej_prerror = $heat_rej_ecerror = $pump_pwr_ratioerror = $pump_elec_conerror = '';
$boiler_efficiencymsg = $elechiller_efficiencymsg = $design_copmsg = $avg_copmsg = $chlr_elec_conmsg = $heat_rej_prmsg = $heat_rej_ecmsg = $pump_pwr_ratiomsg = $pump_elec_conmsg = '';
$grp1 = $grp2 = $grp3 = '';
$grp1error = $grp2error = $grp3error = '';
$grp1msg = $grp2msg = $grp3msg = '';

// detect form field errors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if ($heat_peak_load !='') {
  if (empty($_POST["boiler_efficiency"])) {
	$boiler_efficiencyerror = "* ";
	$boiler_efficiencymsg = "Please enter a value.";
  } else if (!is_numeric($_POST["boiler_efficiency"])) {
	$boiler_efficiencyerror = "* ";
	$boiler_efficiencymsg = "Please use numeric or decimal characters.";
  } else if (($_POST["boiler_efficiency"]) < 0 || ($_POST["boiler_efficiency"]) > 100) {
	$boiler_efficiencyerror = "* ";
	$boiler_efficiencymsg = "Value must be between 0 and 100.";  
  } else {
  $boiler_efficiency = test_input($_POST["boiler_efficiency"]);
  $_SESSION["boiler_efficiency"] = $boiler_efficiency;
  }
}

if ($cool_peak_load !='') {  
  if (empty($_POST["elechiller_efficiency"])) {
	$elechiller_efficiencyerror = "* ";
	$elechiller_efficiencymsg = "Please enter a value.";
  } else if (!is_numeric($_POST["elechiller_efficiency"])) {
	$elechiller_efficiencyerror = "* ";
	$elechiller_efficiencymsg = "Please use numeric or decimal characters.";
  } else if (($_POST["elechiller_efficiency"]) < 0 || ($_POST["elechiller_efficiency"]) > 100) {
	$elechiller_efficiencyerror = "* ";
	$elechiller_efficiencymsg = "Value must be between 0 and 100.";  
  } else {
  $elechiller_efficiency = test_input($_POST["elechiller_efficiency"]);
  $_SESSION["elechiller_efficiency"] = $elechiller_efficiency;
  }
  
  if (empty($_POST["design_cop"])) {
	$design_coperror = "* ";
	$design_copmsg = "Please enter a value.";
  } else if (!is_numeric($_POST["design_cop"])) {
	$design_coperror = "* ";
	$design_copmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["design_cop"]) < 0 || ($_POST["design_cop"]) > 8) {
	$design_coperror = "* ";
	$design_copmsg = "Value must be between 0 and 8.";  
  } else {
  $design_cop = test_input($_POST["design_cop"]);
  $_SESSION["design_cop"] = $design_cop;
  }
  
  if (empty($_POST['grp1'])) {
  $grp1error = '*';
  $grp1msg = 'Please select an option.';
  } else { 
  $grp1 = $_POST['grp1'];
  }
  if ($grp1 == 'avg_cop_btn') {
  if (empty($_POST["avg_cop"])) {
	$avg_coperror = "* ";
	$avg_copmsg = "Please enter a value.";
  } else if (!is_numeric($_POST["avg_cop"])) {
	$avg_coperror = "* ";
	$avg_copmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["avg_cop"]) < 0 || ($_POST["avg_cop"]) > 8) {
	$avg_coperror = "* ";
	$avg_copmsg = "Value must be between 0 and 8.";
  } else {
  $avg_cop = test_input($_POST["avg_cop"]);
  $_SESSION["avg_cop"] = $avg_cop;
  }
  }
  if ($grp1 == 'chlr_elec_con_btn') {
  if (empty($_POST["chlr_elec_con"])) {
	$chlr_elec_conerror = "* ";
	$chlr_elec_conmsg = "Please enter a value.";
  } else if (!is_numeric($_POST["chlr_elec_con"])) {
	$chlr_elec_conerror = "* ";
	$chlr_elec_conmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["chlr_elec_con"]) < 0 || ($_POST["chlr_elec_con"]) > 1000000000) {
	$chlr_elec_conerror = "* ";
	$chlr_elec_conmsg = "Value must be between 0 and 1,000,000,000.";
  } else {
  $chlr_elec_con = test_input($_POST["chlr_elec_con"]);
  $_SESSION["chlr_elec_con"] = $chlr_elec_con;
  }
  }
	
  if (empty($_POST['grp2'])) {
	  $grp2error = '*';
	  $grp2msg = 'Please select an option.';
  } else {
  $grp2 = $_POST['grp2'];
  }
  if ($grp2 == 'heat_rej_pr_btn') {
	if (empty($_POST["heat_rej_pr"])) {
	$heat_rej_prerror = "* ";
	$heat_rej_prmsg = "Please enter a value.";
  } else if (!is_numeric($_POST["heat_rej_pr"])) {
	$heat_rej_prerror = "* ";
	$heat_rej_prmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["heat_rej_pr"]) < 0 || ($_POST["heat_rej_pr"]) > 100) {
	$heat_rej_prerror = "* ";
	$heat_rej_prmsg = "Value must be between 0 and 100.";
  } else {
  $heat_rej_pr = test_input($_POST["heat_rej_pr"]);
  $_SESSION["heat_rej_pr"] = $heat_rej_pr;
  }
  }
  if ($grp2 == 'heat_rej_ec_btn') {
	if (empty($_POST["heat_rej_ec"])) {
	$heat_rej_ecerror = "* ";
	$heat_rej_ecmsg = "Please enter a value.";
  } else if (!is_numeric($_POST["heat_rej_ec"])) {
	$heat_rej_ecerror = "* ";
	$heat_rej_ecmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["heat_rej_ec"]) < 0 || ($_POST["heat_rej_ec"]) > 1000000000) {
	$heat_rej_ecerror = "* ";
	$heat_rej_ecmsg = "Value must be between 0 and 1,000,000,000."; 
  } else {
  $heat_rej_ec = test_input($_POST["heat_rej_ec"]);
  $_SESSION["heat_rej_ec"] = $heat_rej_ec;
  }
  }
  
    if (empty($_POST['grp3'])) {
	  $grp3error = '*';
	  $grp3msg = 'Please select an option.';
  } else {
  $grp3 = $_POST['grp3'];
  }
  if ($grp3 == 'pump_pwr_ratio_btn') {
	if (empty($_POST["pump_pwr_ratio"])) {
	$pump_pwr_ratioerror = "* ";
	$pump_pwr_ratiomsg = "Please enter a value.";
  } else if (!is_numeric($_POST["pump_pwr_ratio"])) {
	$pump_pwr_ratioerror = "* ";
	$pump_pwr_ratiomsg = "Please use numeric or decimal characters.";
  } else if (($_POST["pump_pwr_ratio"]) < 0 || ($_POST["pump_pwr_ratio"]) > 100) {
	$pump_pwr_ratioerror = "* ";
	$pump_pwr_ratiomsg = "Value must be between 0 and 100.";  
  } else {
  $pump_pwr_ratio = test_input($_POST["pump_pwr_ratio"]);
  $_SESSION["pump_pwr_ratio"] = $pump_pwr_ratio;
  }
  }
  if ($grp3 == 'pump_elec_con_btn') {
	if (empty($_POST["pump_elec_con"])) {
	$pump_elec_conerror = "* ";
	$pump_elec_conmsg = "Please enter a value.";
  } else if (!is_numeric($_POST["pump_elec_con"])) {
	$pump_elec_conerror = "* ";
	$pump_elec_conmsg = "Please use numeric or decimal characters.";
  } else if (($_POST["pump_elec_con"]) < 0 || ($_POST["pump_elec_con"]) > 1000000000) {
	$pump_elec_conerror = "* ";
	$pump_elec_conmsg = "Value must be between 0 and 1,000,000,000."; 
  } else {
  $pump_elec_con = test_input($_POST["pump_elec_con"]);
  $_SESSION["pump_elec_con"] = $pump_elec_con;
  }
  }
}

if ($heat_peak_load !='' && $cool_peak_load =='') { 
  if ($boiler_efficiency !='') {
	  header('Location: costest4.php');
	  exit;
  }
}

if ($heat_peak_load =='' && $cool_peak_load !='') { 
  if ($elechiller_efficiency !='' && $design_cop !='' && ($avg_cop !='' || $chlr_elec_con !='') && ($heat_rej_pr !='' || $heat_rej_ec !='') && ($pump_pwr_ratio !='' || $pump_elec_con !='')) {
	  header('Location: costest4.php');
	  exit;
  }
}

if ($heat_peak_load !='' && $cool_peak_load !='') { 
  if ($boiler_efficiency !='' && $elechiller_efficiency !='' && $design_cop !='' && ($avg_cop !='' || $chlr_elec_con !='') && ($heat_rej_pr !='' || $heat_rej_ec !='') && ($pump_pwr_ratio !='' || $pump_elec_con !='')) {
	  header('Location: costest4.php');
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<SCRIPT LANGUAGE="JavaScript">
function hidetabs() {
	if ("<?php echo $cool_peak_load;?>"=='') {
		document.getElementById('coolappfields').hidden=true;
	} else if ("<?php echo $heat_peak_load;?>"=='') {
		document.getElementById('heatappfields').hidden=true;
	}
}

function grp1sel() {

if(document.getElementById('avg_cop_btn').checked)
{
document.getElementById('avg_cop').disabled=false;
document.getElementById('chlr_elec_con').disabled=true;
//document.getElementById('cec_unit').disabled=true;
}
else if(document.getElementById('chlr_elec_con_btn').checked)
{
document.getElementById('avg_cop').disabled=true;
document.getElementById('chlr_elec_con').disabled=false;
//document.getElementById('cec_unit').disabled=false;
}
}

function grp2sel() {

if(document.getElementById('heat_rej_pr_btn').checked)
{
document.getElementById('heat_rej_pr').disabled=false;
document.getElementById('heat_rej_ec').disabled=true;
//document.getElementById('hrec_unit').disabled=true;
}
else if(document.getElementById('heat_rej_ec_btn').checked)
{
document.getElementById('heat_rej_pr').disabled=true;
document.getElementById('heat_rej_ec').disabled=false;
//document.getElementById('hrec_unit').disabled=false;
}
}

function grp3sel() {

if(document.getElementById('pump_pwr_ratio_btn').checked)
{
document.getElementById('pump_pwr_ratio').disabled=false;
document.getElementById('pump_elec_con').disabled=true;
//document.getElementById('pec_unit').disabled=true;
}
else if(document.getElementById('pump_elec_con_btn').checked)
{
document.getElementById('pump_pwr_ratio').disabled=true;
document.getElementById('pump_elec_con').disabled=false;
//document.getElementById('pec_unit').disabled=false;
}
}

function defaults() {
	if("<?php echo $cool_peak_load;?>"=='' && "<?php echo $heat_peak_load;?>"!='') {
		document.getElementById('boiler_efficiency').value = 90;
	} else if("<?php echo $cool_peak_load;?>"!='' && "<?php echo $heat_peak_load;?>"=='') {
		document.getElementById('elechiller_efficiency').value = 90;
		document.getElementById('design_cop').value = 5.5;
	} else if("<?php echo $cool_peak_load;?>"!='' && "<?php echo $heat_peak_load;?>"!='') {
		document.getElementById('boiler_efficiency').value = 90;
		document.getElementById('elechiller_efficiency').value = 90;
		document.getElementById('design_cop').value = 5.5;
	}
	if(document.getElementById('avg_cop_btn').checked) {
			document.getElementById('avg_cop').value = 3.05;
			document.getElementById('chlr_elec_con').value = '';
		} else if(document.getElementById('chlr_elec_con_btn').checked) {
			document.getElementById('avg_cop').value = '';
			document.getElementById('chlr_elec_con').value = 2218766;
		}
		if(document.getElementById('heat_rej_pr_btn').checked) {
			document.getElementById('heat_rej_pr').value = 9;
			document.getElementById('heat_rej_ec').value = '';
		} else if(document.getElementById('heat_rej_ec_btn').checked) {
			document.getElementById('heat_rej_pr').value = '';
			document.getElementById('heat_rej_ec').value = 197050;
		}
		if(document.getElementById('pump_pwr_ratio_btn').checked) {
			document.getElementById('pump_pwr_ratio').value = 5;
			document.getElementById('pump_elec_con').value = '';
		} else if(document.getElementById('pump_elec_con_btn').checked) {
			document.getElementById('pump_pwr_ratio').value = '';
			document.getElementById('pump_elec_con').value = 110938;
		}
}

function start() {
	hidetabs();
	grp1sel();
	grp2sel();
	grp3sel();
}
window.onload = start;
</SCRIPT>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Baseline System Info</title>
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
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Baseline System Info</b><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Choose Technology<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Transportation Info<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Project Info<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Calculate
</div>


<form class = "input" method = "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="htcl1">
<div id="heatappfields"><span class = "error"><?php echo $boiler_efficiencyerror;?></span>Boiler efficiency:
<input type = "text" name="boiler_efficiency" id="boiler_efficiency" size="10" value="<?php echo $boiler_efficiency;?>"> %
<br/><span class = "error"><?php echo $boiler_efficiencymsg;?></span>
<br/>
</div>
<div id="coolappfields"><span class = "error"><?php echo $elechiller_efficiencyerror;?></span>EleChiller efficiency:
<input type = "text" name="elechiller_efficiency" id="elechiller_efficiency" size="10" value="<?php echo $elechiller_efficiency;?>"> %
<br/><span class = "error"><?php echo $elechiller_efficiencymsg;?></span>
<br/>
<span class = "error"><?php echo $design_coperror;?></span>Design COP:
<input type = "text" name="design_cop" id="design_cop" size="10" value="<?php echo $design_cop;?>">
<br><span class = "error"><?php echo $design_copmsg;?></span>
<br>
<div class = "parabox"><span class = "error"><?php echo $grp1error;?></span><input type="radio" onclick="grp1sel()" name="grp1" value="avg_cop_btn" id="avg_cop_btn" <?php if (isset($_POST['grp1']) && $_POST['grp1'] == 'avg_cop_btn') echo 'checked = "checked"';?>>
<span class = "error"><?php echo $avg_coperror;?></span> Average COP: <input type="text" name="avg_cop" id="avg_cop" size="10" value="<?php echo $avg_cop;?>" disabled>
<br><span class = "error"><?php echo $avg_copmsg;?></span>
<br>
<span class = "error"><?php echo $grp1error;?></span><input type="radio" onclick="grp1sel()" name="grp1" value="chlr_elec_con_btn" id="chlr_elec_con_btn" <?php if (isset($_POST['grp1']) && $_POST['grp1'] == 'chlr_elec_con_btn') echo 'checked = "checked"';?>>
<span class = "error"><?php echo $chlr_elec_conerror;?></span> Chiller electricity consumption: <input type="text" name="chlr_elec_con" id="chlr_elec_con" size="10" value="<?php echo $chlr_elec_con;?>" disabled> kWh/yr
<!--<select name="cec_unit" id="cec_unit" disabled>
	<option value="unit1">Unit 1</option>
	<option value="unit2">Unit 2</option>
	<option value="unit3">Unit 3</option>
	</select>-->
	<br/><span class = "error"><?php echo $chlr_elec_conmsg;?></span>
</div><span class = "error"><?php echo $grp1msg;?></span>
<br>
<div class = "parabox">
<span class = "error"><?php echo $grp2error;?></span><input type="radio" onclick="grp2sel()" name="grp2" value="heat_rej_pr_btn" id="heat_rej_pr_btn" <?php if (isset($_POST['grp2']) && $_POST['grp2'] == 'heat_rej_pr_btn') echo 'checked = "checked"';?>>
<span class = "error"><?php echo $heat_rej_prerror;?></span> Heat rejection power ratio: <input type="text" name="heat_rej_pr" id="heat_rej_pr" size="10" value="<?php echo $heat_rej_pr;?>" disabled> %
<br><span class = "error"><?php echo $heat_rej_prmsg;?></span>
<br>
<span class="error"><?php echo $grp2error;?></span><input type="radio" onclick="grp2sel()" name="grp2" value="heat_rej_ec_btn" id="heat_rej_ec_btn" <?php if (isset($_POST['grp2']) && $_POST['grp2'] == 'heat_rej_ec_btn') echo 'checked = "checked"';?>>
<span class = "error"><?php echo $heat_rej_ecerror;?></span> Heat rejection electricity consumption: <input type="text" name="heat_rej_ec" id="heat_rej_ec" size="10" value="<?php echo $heat_rej_ec;?>" disabled> kWh/yr
<!--<select name="hrec_unit" id="hrec_unit" disabled>
	<option value="unit1">Unit 1</option>
	<option value="unit2">Unit 2</option>
	<option value="unit3">Unit 3</option>
	</select>-->
	<br/><span class = "error"><?php echo $heat_rej_ecmsg;?></span>
</div><span class = "error"><?php echo $grp2msg;?></span>
<br>
<div class = "parabox">
<span class="error"><?php echo $grp3error;?></span><input type="radio" onclick="grp3sel()" name="grp3" value="pump_pwr_ratio_btn" id="pump_pwr_ratio_btn" <?php if (isset($_POST['grp3']) && $_POST['grp3'] == 'pump_pwr_ratio_btn') echo 'checked = "checked"';?>>
<span class = "error"><?php echo $pump_pwr_ratioerror;?></span> Pump power ratio (vs. chiller): <input type="text" name="pump_pwr_ratio" id="pump_pwr_ratio" value="<?php echo $pump_pwr_ratio;?>" size="10" disabled> %
<br><span class = "error"><?php echo $pump_pwr_ratiomsg;?></span>
<br>
<span class="error"><?php echo $grp3error;?></span><input type="radio" onclick="grp3sel()" name="grp3" value="pump_elec_con_btn" id="pump_elec_con_btn" <?php if (isset($_POST['grp3']) && $_POST['grp3'] == 'pump_elec_con_btn') echo 'checked = "checked"';?>>
<span class = "error"><?php echo $pump_elec_conerror;?></span> Pump electricity consumption: <input type="text" name="pump_elec_con" id="pump_elec_con" size="10" value="<?php echo $pump_elec_con;?>" disabled> kWh/yr
<!--<select name="pec_unit" id="pec_unit" disabled>
	<option value="unit1">Unit 1</option>
	<option value="unit2">Unit 2</option>
	<option value="unit3">Unit 3</option>
	</select>-->
	<br/><span class="error"><?php echo $pump_elec_conmsg;?></span>
</div><span class = "error"><?php echo $grp3msg;?></span>
</div>
<br />
<button type="button" onclick="defaults()">Use Default Values</button>
  <br />
  <br />
<input type="button" value="Previous" onclick="history.go(-1);return true;">
<input type="submit" value="Next">

</form>
</body>
</html>