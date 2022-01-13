<?php
$dirs = [
    __DIR__ . '/Operations',
    __DIR__ . '/Model',
    __DIR__ . '/Decorator',
    __DIR__
];

spl_autoload_register(function ($className) use($dirs) {
    // get off namespace
    $exploded = explode('\\', $className);
    $filename = end($exploded) . '.php';
    foreach ($dirs as $dir) {
        if (file_exists($dir . DIRECTORY_SEPARATOR . $filename)) {
            include $dir . DIRECTORY_SEPARATOR . $filename;
        }
    }
});

//foreach ($dirs as $dir) {
//    foreach (scandir($dir) as $file) {
//        if($file === '.' || $file === '..' || $file === 'loader.php') continue;
//        if (is_file($dir . DIRECTORY_SEPARATOR . $file)) {
//            echo $dir . DIRECTORY_SEPARATOR . $file . "\n";
//            require $dir . DIRECTORY_SEPARATOR . $file;
//        }
//    }
//}

$x = new \FSAirlinesPhpIntegration\Connector('fdicagly1k4f', '49142');

// $r = $x->operation()->getAircraftDBList();
// $r = $x->operation()->getAircraftStats(152835);
// $r = $x->operation()->getActiveFlights(); // not found when no flights
// $r = $x->operation()->getBookedFlights(); // not found when no flights
// $r = $x->operation()->getAirlineData(49142);
// $r = $x->operation()->getAirlineStats();
// $r = $x->operation()->getAirportData('MBPV'); // report not foud
// $r = $x->operation()->getAirportPackageSummary('MBPV');
// $r = $x->operation()->getAirportList();
// $r = $x->operation()->getRouteList();
// $r = $x->operation()->getRouteData(19853680);
// $r = $x->operation()->pilotLogin('brazvo', 'Bruno#429');
// $r = $x->operation()->getBookableRoutes(119018, '17d71e661920d4383be28a74e99514d8');
// $r = $x->operation()->getBookableAircraft(119018, '17d71e661920d4383be28a74e99514d8', 19853576);
// $r = $x->operation()->bookFlight(119018, '17d71e661920d4383be28a74e99514d8', 19853576, 130433);
// $r = $x->operation()->cancelFlight(119018, '17d71e661920d4383be28a74e99514d8');
// $r = $x->operation()->getBookStatus(119018);
// $r = $x->operation()->getCenterPackages(4436);
// $r = $x->operation()->getCountryStats('Germany'); // Not found when no stats
//$r = $x->operation()->getDistance('MBPV', 'MBGT');
//$r = $x->operation()->getFleetList();
//$r = $x->operation()->getFleetAircraftList(80642);
//$r = $x->operation()->getFleetStats();
// $r = $x->operation()->getFlightReports( null, 5);
//$r = $x->operation()->getFlightReportsByAircraftId( 170701,null, 5);
//$r = $x->operation()->getFlightReportsByAircraftDBId( 1010, 5); // report bug
// $r = $x->operation()->getFlightReportsByPilotId( 119018,null, 5);
//$r = $x->operation()->getLast10Transactions( );
//$r = $x->operation()->getLeasedAircraftList();
//$r = $x->operation()->getMetar('MBPV');
//$r = $x->operation()->getNegTransactionSums();
//$r = $x->operation()->getPosTransactionSums();
//$r = $x->operation()->getPeriodFleetStats((time() - 5*84000), time());
// $r = $x->operation()->getPeriodPilotStats((time() - 5*84000), time());
//$r = $x->operation()->getPilotList();
//$r = $x->operation()->getPilotData(119018);
//$r = $x->operation()->getPilotHours(119018);
//$r = $x->operation()->getPilotID('brazvo', '17d71e661920d4383be28a74e99514d8');
//$r = $x->operation()->getPilotRatings(119018);
//$r = $x->operation()->getPilotStatus(119018); // not found when not flying
//$r = $x->operation()->getPilotStats();
//$r = $x->operation()->getPrivacyPolicy();
//$r = $x->operation()->getRankList();
//$r = $x->operation()->getReportDetail(3158087);
//$r = $x->operation()->getTransferCost('MBPV', 'TJSJ');
$r = $x->operation()->getVaPackageSummary();
// $r = $x->operation()->transferPilot(119018, '17d71e661920d4383be28a74e99514d8', 'MBPV');

var_dump($r);
var_dump($r->getStatus());
