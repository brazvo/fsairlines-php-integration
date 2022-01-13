<?php

namespace FSAirlinesPhpIntegration;

use FSAirlinesPhpIntegration\Model\ResponseInterface;

/**
 * @method ResponseInterface getPilotList()
 * @method ResponseInterface getAircraftList()
 * @method ResponseInterface getPilotData($pilotId)
 * @method ResponseInterface getAircraftData($aircraftId)
 * @method ResponseInterface getAircraftStats($aircraftId)
 * @method ResponseInterface getAircraftDBData($aircraftDBId)
 * @method ResponseInterface getAircraftDBList()
 * @method ResponseInterface getFleetAircraftList($fleetId)
 * @method ResponseInterface getFleetList()
 * @method ResponseInterface getFleetStats()
 * @method ResponseInterface getLeasedAircraftList()
 * @method ResponseInterface getPeriodFleetStats($fromTimestamp, $toTimestamp)
 * @method ResponseInterface getPeriodPilotStats($fromTimestamp, $toTimestamp)
 * @method ResponseInterface getAirportData($icao)
 * @method ResponseInterface getAirportList()
 * @method ResponseInterface getAirlineData($id)
 * @method ResponseInterface getAirlineStats()
 * @method ResponseInterface getCountryStats($country)
 * @method ResponseInterface getRankList()
 * @method ResponseInterface getLast10Transactions()
 * @method ResponseInterface getNegTransactionSums()
 * @method ResponseInterface getPosTransactionSums()
 * @method ResponseInterface getActiveFlights()
 * @method ResponseInterface getBookedFlights()
 * @method ResponseInterface getFlightReports($days,$count)
 * @method ResponseInterface getFlightReportsByPilotId($pilotId,$days,$count)
 * @method ResponseInterface getFlightReportsByAircraftId($acId,$days,$count)
 * @method ResponseInterface getFlightReportsByAircraftDBId($acDbId,$days,$count)
 * @method ResponseInterface getReportDetail($reportId)
 * @method ResponseInterface getRouteData($routeId)
 * @method ResponseInterface getRouteList()
 * @method ResponseInterface getPilotHours($pilotId)
 * @method ResponseInterface getPilotRatings($pilotId)
 * @method ResponseInterface getPilotStatus($pilotId)
 * @method ResponseInterface getPilotStats()
 * @method ResponseInterface bookFlight($pilotId, $loginToken, $routeId, $aircraftId)
 * @method ResponseInterface getBookableAircraft($pilotId, $loginToken, $routeId)
 * @method ResponseInterface cancelFlight($pilotId, $loginToken)
 * @method ResponseInterface getBookableRoutes($pilotId, $loginToken)
 * @method ResponseInterface getBookStatus($pilotId)
 * @method ResponseInterface getPilotID($username, $loginToken)
 * @method ResponseInterface getPrivacyPolicy()
 * @method ResponseInterface getTransferCost($departure, $arrival)
 * @method ResponseInterface transferPilot($pilotId, $loginToken, $icao)
 * @method ResponseInterface getDistance($icaoFrom, $icaoTo)
 * @method ResponseInterface getMetar($icao)
 * @method ResponseInterface getAirportPackageSummary($icao)
 * @method ResponseInterface getVaPackageSummary()
 * @method ResponseInterface getAircraftPackages($aircraftId)
 * @method ResponseInterface getCenterPackages($centerId)
 * @method ResponseInterface pilotLogin($username, $password)
 */
class OperationLoader
{
    /**
     * @var Connector
     */
    private $connector;

    /**
     * @param Connector $connector
     */
    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function __call($name, $arguments) {
        $className = '\\FSAirlinesPhpIntegration\\Operations\\' . ucfirst($name);
        $operation = new $className(
            $this->connector->getApiUrl(),
            $this->connector->getApiKey(),
            $this->connector->getAirlineId(),
            $this->connector->getPilotId(),
            $this->connector->isRawData(),
            $this->connector->getRawDataFormat()
        );

        if (!$this->isInvokable($operation)) {
            throw new \Exception("$className must contain __invoke method");
        }

        return call_user_func_array($operation, $arguments);
    }

    /**
     *
     * @param object $object
     * @return boolean
     */
    protected function isInvokable( $object )
    {
        $rc = new \ReflectionClass( $object );
        return $rc->hasMethod('__invoke');
    }
}
