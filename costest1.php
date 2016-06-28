<?php
session_start(); // start session for containing variables across interface

// connect to server
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
	$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
	    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	}
	catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$varnames = array("fluidt","ftunits","wetbulbt","wetbulbunits","siteinvest","opcost","opcostunits","pg1complete");

for ($k=0;$k<count($varnames);$k++) {
	if ($_SESSION[$varnames[$k]]!='') {
		${$varnames[$k]} = $_SESSION[$varnames[$k]];
	} else {
	${$varnames[$k]} = '';
	}
}	

$_SESSION["pg1complete"] = "yes";	
//if($_SESSION["fluidt"]!='')	{
	//$fluidt = $_SESSION["fluidt"];
//} else {
	//$fluidt = '';
//}
//if($_SESSION["ftunits"]!='')	{
	//$ftunits = $_SESSION["ftunits"];
//} else {
	//$ftunits = '';
//}
//if($_SESSION["wetbulbt"]!='')	{
	//$wetbulbt = $_SESSION["wetbulbt"];
//} else {
	//$wetbulbt = '';
//}
//if($_SESSION["wetbulbunits"]!='')	{
	//$wetbulbunits = $_SESSION["wetbulbunits"];
//} else {
	//$wetbulbunits = '';
//}
//if($_SESSION["siteinvest"]!='')	{
	//$siteinvest = $_SESSION["siteinvest"];
//} else {
	//$siteinvest = '';
//}
//if($_SESSION["opcost"]!='')	{
	//$opcost = $_SESSION["opcost"];
//} else {
	//$opcost = '';
//}
//if($_SESSION["opcostunits"]!='')	{
	//$opcostunits = $_SESSION["opcostunits"];
//} else {
	//$opcostunits = '';
//}
	
// define error variables and set to empty values
$fluidterror = $fluidterrormsg = $wetbulbterror = $wetbulbterrormsg = $siteinvesterror = $siteinvesterrormsg = $opcosterror = $opcosterrormsg = '';

// detect form field errors
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$ftunits = test_input($_POST["ftunits"]);
	$_SESSION["ftunits"] = $ftunits;
  if (($_POST["fluidt"])=='') {
	$fluidterror = "* ";
	$fluidterrormsg = "Please input a value.";
	$_SESSION["fluidt"] = '';
  } else if (!is_numeric($_POST["fluidt"])) {
    $fluidterror = "* ";
	$fluidterrormsg = "Please use only numeric or decimal characters.";
	$_SESSION["fluidt"] = '';
  } else if($_POST["ftunits"]=="celsius") {
	if (($_POST["fluidt"]) < 60 || ($_POST["fluidt"]) > 150) {
	$fluidterror = "* ";
	$fluidterrormsg = "Value must be between 60 and 150 &deg;C.";
	$_SESSION["fluidt"] = '';
	} else {
    $fluidt = test_input($_POST["fluidt"]);
    $_SESSION["fluidt"] = $fluidt;
	$ftunits = test_input($_POST["ftunits"]);
	$_SESSION["ftunits"] = $ftunits;
	}
  } else if($_POST["ftunits"]=="fahrenheit") {
	if (($_POST["fluidt"]) < 140 || ($_POST["fluidt"]) > 302) {
	$fluidterror = "* ";
	$fluidterrormsg = "Value must be between 140 and 302 &deg;F.";
	$ftunits = test_input($_POST["ftunits"]);
	$_SESSION["ftunits"] = $ftunits;
	$_SESSION["fluidt"] = '';
	} else {
  $fluidt = (test_input($_POST["fluidt"])-32)*(5/9);
  $_SESSION["fluidt"] = $fluidt;
  $ftunits = "celsius";
	$_SESSION["ftunits"] = $ftunits;
  }
  }
  
  $wetbulbunits = test_input($_POST["wetbulbunits"]);
  $_SESSION["wetbulbunits"] = $wetbulbunits;
  if ($_POST["wetbulbt"]=='') {
	$wetbulbterror = "* ";
	$wetbulbterrormsg = "Please input a value.";
	$_SESSION["wetbulbt"] = '';
  } else if (!is_numeric($_POST["wetbulbt"])) {
	$wetbulbterror = "* ";
	$wetbulbterrormsg = "Please use only numeric or decimal characters.";
	$_SESSION["wetbulbt"] = '';
  } else if($_POST["wetbulbunits"]=="celsius") {
	if(($_POST["wetbulbt"]) < 0 || ($_POST["wetbulbt"]) > 50) {
    $wetbulbterror = "* ";
	$wetbulbterrormsg = "Value must be between 0 and 50 &deg;C.";
	$_SESSION["wetbulbt"] = '';
	} else {
	$wetbulbt = test_input($_POST["wetbulbt"]);
    $_SESSION["wetbulbt"] = $wetbulbt;
	$wetbulbunits = test_input($_POST["wetbulbunits"]);
  $_SESSION["wetbulbunits"] = $wetbulbunits;
	}
  } else if($_POST["wetbulbunits"]=="fahrenheit") {
	if(($_POST["wetbulbt"]) < 32 || ($_POST["wetbulbt"]) > 122) {
    $wetbulbterror = "* ";
	$wetbulbterrormsg = "Value must be between 32 and 122 &deg;F.";
	$_SESSION["wetbulbt"] = '';
	$wetbulbunits = test_input($_POST["wetbulbunits"]);
  $_SESSION["wetbulbunits"] = $wetbulbunits;
	} else {
	$wetbulbt = (test_input($_POST["wetbulbt"])-32)*(5/9);
    $_SESSION["wetbulbt"] = $wetbulbt;
	$wetbulbunits = "celsius";
	$_SESSION["wetbulbunits"] = $wetbulbunits;
	}
  }
  
  if (($_POST["siteinvest"])=='') {
	$siteinvesterror = "* ";
	$siteinvesterrormsg = "Please input a value.";  
	$_SESSION["siteinvest"] = '';
  } else if(!is_numeric($_POST["siteinvest"])) {
	$siteinvesterror = "* ";
	$siteinvesterrormsg = "Please use only numeric or decimal characters.";
	$_SESSION["siteinvest"] = '';
  } else if(($_POST["siteinvest"]) < 0 || ($_POST["siteinvest"]) > 1000000000) {
	$siteinvesterror = "* ";
	$siteinvesterrormsg = "Value must be between 0 and 1,000,000,000.";
	$_SESSION["siteinvest"] = '';
  } else {
  $siteinvest = test_input($_POST["siteinvest"]);
  $_SESSION["siteinvest"] = $siteinvest;
  }
  
  if (($_POST["opcost"])=='') {
	$opcosterror = "* ";
	$opcosterrormsg = "Please input a value.";
	$_SESSION["opcost"] = '';
  } else if(!is_numeric($_POST["opcost"])) {
	$opcosterror = "* ";
	$opcosterrormsg = "Please use only numeric or decimal characters.";
	$_SESSION["opcost"] = '';
  } else if(($_POST["opcost"]) < 0 || ($_POST["opcost"]) > 1000000) {
    $opcosterror = "* ";
	$opcosterrormsg = "Value must be between 0 and 1,000,000.";
	$_SESSION["opcost"] = '';
  } else {
  $opcost = test_input($_POST["opcost"]);
  $_SESSION["opcost"] = $opcost;
  $opcostunits = test_input($_POST["opcostunits"]);
  $_SESSION["opcostunits"] = $opcostunits;
  }
  if ($_SESSION["fluidt"] !='' && $_SESSION["wetbulbt"] !='' && $_SESSION["siteinvest"] !='' && $_SESSION["opcost"] !='') {
	  header('Location: costest2.php');
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

<script Language="JavaScript">
function defaults() {
	document.getElementById('fluidt').value = 100;
	document.getElementById('ftunits').value = "celsius";
	document.getElementById('wetbulbt').value = 23.8;
	document.getElementById('wetbulbunits').value = "celsius";
	document.getElementById('siteinvest').value = 0;
	document.getElementById('opcost').value = 0;
	document.getElementById('opcostunits').value = "day";
}

function sidebarlinks() {
	var pg1 = <?php echo json_encode($_SESSION["pg1complete"]) ?>;
	var pg2 = <?php echo json_encode($_SESSION["pg2complete"]) ?>;
	var pg3 = <?php echo json_encode($_SESSION["pg3complete"]) ?>;
	var pg4 = <?php echo json_encode($_SESSION["pg4complete"]) ?>;
	var pg5 = <?php echo json_encode($_SESSION["pg5complete"]) ?>;
	var pg6 = <?php echo json_encode($_SESSION["pg6complete"]) ?>;
	
	if(pg2!='') {
		document.getElementById('pg2link').innerHTML = "<a href='costest2.php'>Building Site Info</a>";
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

window.onload = sidebarlinks;
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Geothermal Site Info</title>
<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>

<!--// header -->
<div class="headerbar">
</div>

<!--// progress bar  -->
<div class="progresslabels">
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Geothermal Site Info</b><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg2link">Building Site Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg3link">Baseline System Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg4link">Choose Technology</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg5link">Transportation Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg6link">Project Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Results
</div>

<!-- form -->
<form class="input" name="economic1" id="economic1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <span class="error"><?php echo $fluidterror;?></span>Geothermal fluid temperature:
  <input name="fluidt" id="fluidt" type="text" size="10" value="<?php echo $_SESSION["fluidt"];?>"/>
  <select name="ftunits" id="ftunits">
    <option value="fahrenheit" <?php if($ftunits=="fahrenheit") echo "selected='selected'";?>>Fahrenheit</option>
	<option value="celsius" <?php if($ftunits=="celsius") echo "selected='selected'";?>>Celsius</option>	
  </select>
  <br /><span class="error"><?php echo $fluidterrormsg;?></span>
  <br />
  <span class="error"><?php echo $wetbulbterror;?></span>Average wet-bulb temperature:
  <input name="wetbulbt" id="wetbulbt" type="text" size="10" value="<?php echo $_SESSION["wetbulbt"];?>"/>
  <select name="wetbulbunits" id="wetbulbunits">
    <option value="fahrenheit" <?php if($wetbulbunits=="fahrenheit") echo "selected='selected'";?>>Fahrenheit</option>
	<option value="celsius" <?php if($wetbulbunits=="celsius") echo "selected='selected'";?>>Celsius</option>
  </select>
  <br /><span class="error"><?php echo $wetbulbterrormsg;?></span>
  <br />
  <span class="error"><?php echo $siteinvesterror;?></span>Geothermal site investment: $
  <input name="siteinvest" id="siteinvest" type="text" size="10" value="<?php echo $_SESSION["siteinvest"];?>"/>
  <br /><span class="error"><?php echo $siteinvesterrormsg;?></span>
  <br />
  <span class="error"><?php echo $opcosterror;?></span>Geothermal site operation cost: $
  <input name="opcost" id="opcost" type="text" size="10" value="<?php echo $_SESSION["opcost"];?>"/>
  /
  <select name="opcostunits" id="opcostunits">
    <option value="day">Day</option>
    <option value="month">Month</option>
    <option value="year">Year</option>
  </select>
  <br /><span class="error"><?php echo $opcosterrormsg;?></span>
  <br />
  <button type="button" onclick="defaults()">Use Default Values</button>
  <br />
  <br />
  <input type="button" value="Start Over" onclick="location.href='begin.php'"><input type="submit" value="Save and Continue">
</form>

</body>
</html>
