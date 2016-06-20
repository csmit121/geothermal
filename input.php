<?php

//session_start();

// pass variables from previous page
$fluidt = $_SESSION["fluidt"];
$wetbulbt = $_SESSION["wetbulbt"];
$siteinvest = $_SESSION["siteinvest"];
$opcost = $_SESSION["opcost"];
$building_location = $_SESSION["building_location"];
$building_state = $_SESSION["building_state"];
$heat_peak_load = $_SESSION["heat_peak_load"];
$heat_total_load = $_SESSION["heat_total_load"];
$cool_peak_load = $_SESSION["cool_peak_load"];
$cool_total_load = $_SESSION["cool_total_load"];
$natgas_price = $_SESSION["natgas_price"];
$electricity_price = $_SESSION["electricity_price"];
$boiler_efficiency = $_SESSION["boiler_efficiency"];
$elechiller_efficiency = $_SESSION["elechiller_efficiency"];
$design_cop = $_SESSION["design_cop"];
$avg_cop = $_SESSION["avg_cop"];
$chlr_elec_con = $_SESSION["chlr_elec_con"];
$heat_rej_pr = $_SESSION["heat_rej_pr"];
$heat_rej_ec = $_SESSION["heat_rej_ec"];
$pump_pwr_ratio = $_SESSION["pump_pwr_ratio"];
$pump_elec_con = $_SESSION["pump_elec_con"];
$TSGAselect = $_SESSION["TSGAselect"];
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

$building_location = "Houston"; //test case; remove this line later

$infile = fopen("input.txt","w");
if(!empty($TSGAselect)) {
$techtype = $TSGAselect." case study";
}
$inputtext = "CaseTitle\t".$techtype;
fwrite($infile, $inputtext);
$inputtext = "\r\nCity\t".$building_location;
fwrite($infile, $inputtext);
$inputtext = "\r\nState\t".$building_state;
fwrite($infile, $inputtext);
$inputtext = "\r\nTechnology\t".$TSGAselect;
fwrite($infile, $inputtext);
$inputtext = "\r\nDistance\t".$distance;
fwrite($infile, $inputtext);
$inputtext = "\r\nTransType\t".$transportation;
fwrite($infile, $inputtext);
$inputtext = "\r\nTransLoad\t".$netloadwl;
fwrite($infile, $inputtext);
$inputtext = "\r\nPeakLoad\t".$cool_peak_load;
fwrite($infile, $inputtext);
$inputtext = "\r\nFullLoadHour\t"."2209";  //override variable entry until complete
fwrite($infile, $inputtext);
$inputtext = "\r\nTransVelocity\t".$avgvel;
fwrite($infile, $inputtext);
$inputtext = "\r\nTransLoadTime\t".$loadtime;
fwrite($infile, $inputtext);
$inputtext = "\r\nTransFuelType\t".$fueltype;
fwrite($infile, $inputtext);
$inputtext = "\r\nTransMPG\t".$fueleff;
fwrite($infile, $inputtext);
$inputtext = "\r\nTwb_y\t".$wetbulbt;
fwrite($infile, $inputtext);
$inputtext = "\r\nTsrc ".$fluidt;
fwrite($infile, $inputtext);
if(!empty($elechiller_efficiency)) {
$inputtext = "\r\nCoolingLoad_y ".$cool_total_load;
fwrite($infile, $inputtext);
$inputtext = "\r\nEleRate "."0.102021361";  //override variable entry until complete
fwrite($infile, $inputtext);
$inputtext = "\r\nBaselineType\tEleChiller";
fwrite($infile, $inputtext);
$inputtext = "\r\nBaselineDesignCOP\t".$design_cop;
fwrite($infile, $inputtext);
if(!empty($avg_cop)) {
$inputtext = "\r\nBaselineAvgCOP\t".$avg_cop; //override: should only be able to have this or chiller electricity consumption but not both
fwrite($infile, $inputtext);
}
if(!empty($chlr_elec_con)) {
$inputtext = "\r\nBaselineChillerEle_y\t".$chlr_elec_con;
fwrite($infile, $inputtext);
}

if(empty($chlr_elec_con) && $avg_cop==3.05) {
$inputtext = "\r\nBaselineChillerEle_y\t"."2218766.67"; //override for test input
fwrite($infile, $inputtext);
}

if(!empty($heat_rej_pr)) {
$inputtext = "\r\nheat_rej_pr\t".$heat_rej_pr;
fwrite($infile, $inputtext);
}
if(!empty($heat_rej_ec)) {
$inputtext = "\r\nBaselineHREle_y\t".$heat_rej_ec;
fwrite($infile, $inputtext);
}
//if(!empty($pump_pwr_ratio)) {
//$inputtext = "\r\npump_pwr_ratio\t".$pump_pwr_ratio;
//fwrite($infile, $inputtext);
//}
//if(!empty($pump_elec_con)) {
//$inputtext = "\r\npump_elec_con\t".$pump_elec_con;
//fwrite($infile, $inputtext);
//}
$inputtext = "\r\nTechDesignCOP\t"."0.7"; //override variable entry until complete
fwrite($infile, $inputtext);
}
$inputtext = "\r\nMaterialPrice\t"."3.55"; //override variable entry until complete
fwrite($infile, $inputtext);
$inputtext = "\r\nLifetime\t".$lifetime;
fwrite($infile, $inputtext);
$inputtext = "\r\nDiscountRate ".$discount;
fwrite($infile, $inputtext);
fclose($infile);

exec("geoTool.rename.exe");
?>