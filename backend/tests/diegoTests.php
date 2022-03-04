<?php
/* echo strtotime("now"), "\n";
echo strtotime("10 September 2000"), "\n";
echo strtotime("+1 day"), "\n";
echo strtotime("+1 week"), "\n";
echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
echo strtotime("next Thursday"), "\n";
echo strtotime("last Monday"), "\n"; */
/* $oneDayAgo = strtotime("-1 day");
$now = strtotime("now");
echo ($now - $oneDayAgo);
echo "\n";
echo $now;
echo "\n";
echo $oneDayAgo;
echo "\n";
echo 24 * 60 * 60; */

//Cálculo de fechas
$numDias = 15;
$fechaInicio = "now";
for ($i = 0; $i < $numDias; $i++) {
//Calcula las fechas desde el día de inicio 
$fechas[$i] = date("Y-m-d", strtotime (($numDias - 1- $i) . " days ago", strtotime($fechaInicio)));
echo $fechas[$i];
echo "\n";
}

echo "\n";
print_r($fechas);
echo "\n";
echo "\n";


echo date('Y-m-d');
?>