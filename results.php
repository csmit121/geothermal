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

require 'input.php';

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


//Extract variables and values for graphs
	$baseline_ic = 0;
	$baseline_t_ic = 0;
	$baseline_oc = 0;
	$baseline_t_oc = 0;
	$tsga_ic = 0;
	$tsga_t_ic = 0;
	$tsga_oc = 0;
	$tractor_trailer_oc = 0;
	$tsga_lcoe_ic = 0;
	$tsga_lcoe_oc = 0;
	$tractor_trailer_lcoe_ic = 0;
	$tractor_trailer_lcoe_oc = 0;
	$baseline_primary_energy = 0;
	$tsga_primary_energy = 0;
	$baseline_t_primary_energy = 0;
	$tsga_t_primary_energy = 0;
	$baseline_co2_emission = 0;
	$tsga_co2_emission = 0;
	$baseline_transport_co2_emission = 0;
	$tractor_trailer_co2_emission = 0;

for($h=0;$h<$outputsize;$h++) {
	
	if(strpos($output[$h],'Baseline Initial Cost')!==false) {
		$baseline_ic = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'Baseline Transport Initial Cost')!==false) {
		$baseline_t_ic = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'Baseline Annual Operating Cost')!==false) {
		$baseline_oc = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'Baseline Transport Operating Cost')!==false) {
		$baseline_t_oc = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'TSGA Initial Cost')!==false) {
		$tsga_ic = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'Tractor Trailer Initial Cost')!==false) {
		$tsga_t_ic = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'TSGA Annual Operating Cost')!==false) {
		$tsga_oc = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'Tractor Trailer Annual Operating Cost')!==false) {
		$tractor_trailer_oc = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'TSGA LCOE Initial Cost')!==false) {
		$tsga_lcoe_ic = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'TSGA LCOE Operating Cost')!==false) {
		$tsga_lcoe_oc = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'Tractor Trailer LCOE Initial Cost')!==false) {
		$tractor_trailer_lcoe_ic = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'Tractor Trailer LCOE Operating Cost')!==false) {
		$tractor_trailer_lcoe_oc = substr($output[$h],strpos($output[$h],"$")+1);
	}
	if(strpos($output[$h],'Baseline Primary Energy')!==false) {
		$baseline_primary_energy = substr($output[$h], 25, -4);
	}
	if(strpos($output[$h],'TSGA Primary Energy')!==false) {
		$tsga_primary_energy = substr($output[$h],21,-4);
	}
	if(strpos($output[$h],'Baseline Transport Primary Energy')!==false) {
		$baseline_t_primary_energy = substr($output[$h],35,-4);
	}
	if(strpos($output[$h],'TSGA Transport Primary Energy')!==false) {
		$tsga_t_primary_energy = substr($output[$h],31,-4);
	}
	if(strpos($output[$h],'Baseline CO2 Emission')!==false) {
		$baseline_co2_emission = substr($output[$h],23,-4);
	}
	if(strpos($output[$h],'TSGA CO2 Emission')!==false) {
		$tsga_co2_emission = substr($output[$h],19,-4);
	}
	if(strpos($output[$h],'Baseline Transport CO2 Emission')!==false) {
		$baseline_transport_co2_emission = substr($output[$h],33,-4);
	}
	if(strpos($output[$h],'Tractor Trailer CO2 Emission')!==false) {
		$tractor_trailer_co2_emission = substr($output[$h],30,-4);
	}
}
?>
	
<script language="JavaScript">
function printable() {
	document.getElementById("pgstyle").href = "printstyle.css";
var printContents = document.getElementById("resultscontent").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	window.print();
	document.getElementById("pgstyle").href = "style.css";
	document.body.innerHTML = originalContents;
}
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Results</title>
<link id="pgstyle" href="style.css" rel="stylesheet" type="text/css" />

<!-- Google Charts scripts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

		var tsga_lcoe_ic = <?php echo ($tsga_lcoe_ic); ?>;
		var tsga_lcoe_oc = <?php echo ($tsga_lcoe_oc); ?>;
		var tractor_trailer_lcoe_ic = <?php echo ($tractor_trailer_lcoe_ic); ?>;
		var tractor_trailer_lcoe_oc = <?php echo ($tractor_trailer_lcoe_oc); ?>;
		
		
        var data = google.visualization.arrayToDataTable([
          ['Parameter', 'Cost'],
          ['TSGA LCOE Initial Cost (premium)',     tsga_lcoe_ic],
          ['TSGA LCOE Operating Cost',      tsga_lcoe_oc],
          ['Tractor Trailer LCOE Initial Cost',  tractor_trailer_lcoe_ic],
          ['Tractor Trailer LCOE Operating Cost', tractor_trailer_lcoe_oc],
        ]);

        var options = {
          title: 'LCOE Breakdown',
		  //backgroundColor: '#CCC',
		  fontSize: 10,
		  legend: 'right'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawInitialCost);
google.charts.setOnLoadCallback(drawOperatingCost);
google.charts.setOnLoadCallback(drawEnergyCon);
google.charts.setOnLoadCallback(drawEmission);

function drawInitialCost() {
	
		var baseline_ic = <?php echo ($baseline_ic); ?>;
		var baseline_t_ic = <?php echo ($baseline_t_ic); ?>;
		var tsga_ic = <?php echo ($tsga_ic); ?>;
		var tsga_t_ic = <?php echo ($tsga_t_ic); ?>;
		
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Cost Group');
      data.addColumn('number', 'Chiller System Cost');
      data.addColumn('number', 'Transportation System Cost');

      data.addRows([
        ['Baseline', baseline_ic, baseline_t_ic],
        ['Transported Geothermal', tsga_ic, tsga_t_ic]
      ]);

      var options = {
        title: 'Initial Cost',
		fontSize: 10,
        isStacked: true,
        hAxis: {
          //title: 'Time of Day',
          //format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          format: 'currency'
        },
		legend: 'bottom'
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
	
	function drawOperatingCost() {
	
		var baseline_oc = <?php echo ($baseline_oc); ?>;
		var baseline_t_oc = <?php echo ($baseline_t_oc); ?>;
		var tsga_oc = <?php echo ($tsga_oc); ?>;
		var tractor_trailer_oc = <?php echo ($tractor_trailer_oc); ?>;
		
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Cost Group');
      data.addColumn('number', 'Electricity Cost');
      data.addColumn('number', 'Transportation Cost');

      data.addRows([
        ['Baseline', baseline_oc, baseline_t_oc],
        ['Transported Geothermal', tsga_oc, tractor_trailer_oc]
      ]);

      var options = {
        title: 'Operating Cost',
		fontSize: 10,
        isStacked: true,
        hAxis: {
          //title: 'Time of Day',
          //format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          format: 'currency'
        },
		legend: 'bottom'
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('opcostchart'));
      chart.draw(data, options);
    }
		
	function drawEnergyCon() {
	
		var baseline_primary_energy = <?php echo ($baseline_primary_energy); ?>;
		var tsga_primary_energy = <?php echo ($tsga_primary_energy); ?>;
		var baseline_t_primary_energy = <?php echo ($baseline_t_primary_energy); ?>;
		var tsga_t_primary_energy = <?php echo ($tsga_t_primary_energy); ?>;
		
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Consumption Group');
      data.addColumn('number', 'Electricity');
      data.addColumn('number', 'Transportation Fuel');

      data.addRows([
        ['Baseline', baseline_primary_energy,baseline_t_primary_energy],
        ['Transported Geothermal', tsga_primary_energy,tsga_t_primary_energy]
      ]);

      var options = {
        title: 'Annual Primary Energy Consumption (kWh)',
		fontSize: 10,
        isStacked: true,
        hAxis: {
          //title: 'Time of Day',
          //format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        
		legend: 'bottom'
		
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('energyconchart'));
      chart.draw(data, options);
    }
	
		function drawEmission() {
	
		var baseline_co2_emission = <?php echo ($baseline_co2_emission); ?>;
		var baseline_transport_co2_emission = <?php echo ($baseline_transport_co2_emission); ?>;
		var tsga_co2_emission = <?php echo ($tsga_co2_emission); ?>;
		var tractor_trailer_co2_emission = <?php echo ($tractor_trailer_co2_emission); ?>;
		
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Emission Group');
      data.addColumn('number', 'Electricity');
      data.addColumn('number', 'Transportation Fuel');

      data.addRows([
        ['Baseline', baseline_co2_emission, baseline_transport_co2_emission],
        ['Transported Geothermal', tsga_co2_emission, tractor_trailer_co2_emission]
      ]);

      var options = {
        title: 'Annual Equivalent CO2 Emission (ton)',
		fontSize: 10,
        isStacked: true,
        hAxis: {
          //title: 'Time of Day',
          //format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        
		legend: 'bottom'
		
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('emissionchart'));
      chart.draw(data, options);
    }
    </script>

	
<script language="JavaScript">
function printable() {
	document.getElementById("pgstyle").href = "printstyle.css";
var printContents = document.getElementById("resultscontent").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	window.print();
	document.getElementById("pgstyle").href = "style.css";
	document.body.innerHTML = originalContents;
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
	if(pg5!='') {
		document.getElementById('pg5link').innerHTML = "<a href='costest5.php'>Transportation Info</a>";
	}
	if(pg6!='') {
		document.getElementById('pg6link').innerHTML = "<a href='costest6.php'>Transportation Info</a>";
	}
}

window.onload = sidebarlinks;
</script>

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
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg5link">Transportation Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn-off.png">
<span id="pg6link">Project Info</span><br /><br />
<img style="position:absolute; left:14px" src="bgbar-btn.png">
<b>Results</b>
</div>


<form class="results" method="get" action="costest5.php" name="results">
<input type="button" value="Printable Version" onclick="printable()"><input type="button" value="Previous" onclick="location.href='costest6.php'"><input type="button" value="Start Over" onclick="location.href='begin.php'"><br/><br/>
<div name="resultscontent" id="resultscontent">
<div class = "invisiblebox">

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
</div>
<div class="graphs">
<div class="chart" id="piechart" style="width: 600px; height: 350px;"></div>
<div class="chart" id="chart_div"></div>
<div class="chart" id="opcostchart"></div>
<div class="chart" id="energyconchart"></div>
<div class="chart" id="emissionchart"></div>
</div>

</div>
</form>

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



</body>
</html>
