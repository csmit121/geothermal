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
$lifetime = $_SESSION["lifetime"];
$discount = $_SESSION["discount"];

$output = explode(PHP_EOL, file_get_contents("output.txt"));
$output = str_replace("CaseTitle","Case Title:",$output);
$output = str_replace("Location","Location:",$output);
$output = str_replace("Technology","Technology:",$output);
$output = str_replace("TransType","Transportation Type:",$output);
$output = str_replace("Simple Payback","Simple Payback:",$output);
$output = str_replace("Baseline_IC","Baseline Initial Cost:",$output);
$output = str_replace("Baseline_OPC_y","Baseline Annual Operating Cost:",$output);
$output = str_replace("TSGA_IC","TSGA Initial Cost:",$output);
$output = str_replace("TSGA_OPC_y","TSGA Annual Operating Cost:",$output);
$output = str_replace("TractorTrailer_IC","Tractor Trailer Initial Cost:",$output);
$output = str_replace("TractorTrailer_OPC_y","Tractor Trailer Annual Operating Cost:",$output);
$output = str_replace("LCOE total","LCOE Total:",$output);
$output = str_replace("TSGA_LCOE_IC(premium)","TSGA LCOE Initial Cost (premium):",$output);
$output = str_replace("TSGA_LCOE_OPC","TSGA LCOE Operating Cost:",$output);
$output = str_replace("TractorTrailer_LCOE_IC","Tractor Trailer LCOE Initial Cost:",$output);
$output = str_replace("TractorTrailer_LCOE_OPC","Tractor Trailer LCOE Operating Cost:",$output);
$output = str_replace("Baseline_Energy_y","Annual Baseline Energy:",$output);
$output = str_replace("Baseline_PrimaryEnergy","Baseline Primary Energy:",$output);
$output = str_replace("Baseline_CO2Emission","Baseline CO2 Emission:",$output);
$output = str_replace("TSGA_Energy_y","Annual TSGA Energy:",$output);
$output = str_replace("TSGA_PrimaryEnergy","TSGA Primary Energy:",$output);
$output = str_replace("TSGA_CO2Emission","TSGA CO2 Emission:",$output);
$output = str_replace("TractorTrailer_Energy_y","Annual Tractor Trailer Energy:",$output);
$output = str_replace("TractorTrailer_PrimaryEnergy","Tractor Trailer Primary Energy:",$output);
$output = str_replace("TractorTrailer_CO2Emission","Tractor Trailer CO2 Emission:",$output);

$outputsize = count($output);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Results</title>
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
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
Project Info<br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Calculate</b>
</div>

<form class="results" method="get" action="costest5.php" name="tech">
<div class='listbold'>Calculation Results<br/><br/></div>
<?php for ($i=0;$i<$outputsize;$i++) {
	if($output[$i]==NULL) {
		echo "";
	} else if($output[$i]=="Economics"||$output[$i]=="Energy and Environmental Impact") {
	echo "<div class='listbold'><p>".$output[$i]."</p></div>";
	} else {
		echo "<div class='resultlist'>".$output[$i]."</div>";
}
}
?>





<span hidden>Input Data:

<p>Geothermal Fluid Temperature = <?php echo $fluidt;?></p>
<p>Geothermal Site Investment = <?php echo $siteinvest;?></p>
<p>Geothermal Site Operational Cost = <?php echo $opcost;?></p>
<p>Building Location = <?php echo $building_location;?></p>
<p>Heating Peak Load = <?php echo $heat_peak_load;?></p>
<p>Heating Total Load = <?php echo $heat_total_load;?></p>
<p>Cooling Peak Load = <?php echo $cool_peak_load;?></p>
<p>Cooling Total Load = <?php echo $cool_total_load;?></p>
<p>Natural Gas Price = <?php echo $natgas_price;?></p>
<p>Electricity Price = <?php echo $electricity_price;?></p>
<p>Boiler Efficiency = <?php echo $boiler_efficiency;?></p>
<p>Design COP = <?php echo $design_cop;?></p>
<p>Average COP = <?php echo $avg_cop;?></p>
<p>Chiller Electricity Consumption = <?php echo $chlr_elec_con;?></p>
<p>Heat Rejection Power Ratio = <?php echo $heat_rej_pr;?></p>
<p>Heat Rejection Electricity Consumption = <?php echo $heat_rej_ec;?></p>
<p>Pump Power Ratio (vs. Chiller) = <?php echo $pump_pwr_ratio;?></p>
<p>Pump Electricity Consumption = <?php echo $pump_elec_con;?></p>
<br />
<br />
Technology choice data will be displayed here
<br />
<br />
<p>Transportation = <?php echo $transportation;?></p>
<p>Distance = <?php echo $distance;?></p>
<p>Net Load Weight Limit = <?php echo $netloadwl;?></p>
<p>Transportation Initial Cost = <?php echo $transportinitcost;?></p>
<p>Transportation Operating Cost = <?php echo $transportopcost;?></p>
<p>Fuel Type = <?php echo $fueltype;?></p>
<p>Fuel Efficiency = <?php echo $fueleff;?></p>
<p>Loading Time = <?php echo $loadtime;?></p>
<p>Average Velocity = <?php echo $avgvel;?></p>
<p>Lifetime = <?php echo $lifetime;?></p>
<p>Discount Rate = <?php echo $discount;?></p></span>
</form>

</body>
</html>
