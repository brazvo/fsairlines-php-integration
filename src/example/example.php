<?php

include __DIR__ . '/../../loader.php';

$connector = new \FSAirlinesPhpIntegration\Connector('virtual_airline_access_token', 'virtual_airline_id');

$response = $connector->operation()->getAirportList();
// $response = $connector->operation()->getAircraftDBList();
// $response = $connector->operation()->getActiveFlights(); // not found when no flights
// $response = $connector->operation()->getBookedFlights(); // not found when no flights
// $response = $connector->operation()->getAirlineStats();
// $response = $connector->operation()->getAirportData('LOWL');
// $response = $connector->operation()->getAirportPackageSummary('LOWL');
// $response = $connector->operation()->getRouteList();
// $response = $connector->operation()->pilotLogin('username', 'password');
// $response = $connector->operation()->getCountryStats('Germany'); // Not found when no stats
//$response = $connector->operation()->getDistance('MBPV', 'MBGT');
//$response = $connector->operation()->getFleetList();
//$response = $connector->operation()->getFleetStats();
// $response = $connector->operation()->getFlightReports( null, 5);
//$response = $connector->operation()->getLast10Transactions( );
//$response = $connector->operation()->getLeasedAircraftList();
//$response = $connector->operation()->getMetar('MBPV');
//$response = $connector->operation()->getNegTransactionSums();
//$response = $connector->operation()->getPosTransactionSums();
//$response = $connector->operation()->getPeriodFleetStats((time() - 5*86400), time());
// $response = $connector->operation()->getPeriodPilotStats((time() - 5*86400), time());
//$response = $connector->operation()->getPilotList();
//$response = $connector->operation()->getPilotStats();
//$response = $connector->operation()->getPrivacyPolicy();
//$response = $connector->operation()->getRankList();
//$response = $connector->operation()->getTransferCost('MBPV', 'TJSJ');
//$response = $connector->operation()->getVaPackageSummary();

var_dump($response->getBody());
var_dump($response->getStatus());
