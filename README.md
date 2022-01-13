# brazvo/fsairlines-php-integration

## PHP FSAirlines API Connector (BETA)

**Author:** Branislav Zvolensky  
**Licence:** GPL-3

PHP FSAirlines API Connector provides user firendly interface for FSAirlines API - https://wiki.fsairlines.net/index.php/XML-Interface-v2

### Installation

#### Composer

Firstly, insert VCS repository to your **composer.json** file

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/brazvo/fsairlines-php-integration"
        }
    ]
}
```

Then add to your **composer.json** dependencies:

```json
{
    "require": {
        "brazvo/fsairlines-php-integration": "^0.2.0"
    }
}
```

and run:

```shell
composer install
```

Or run command

```shell
composer require brazvo/fsairlines-php-integration
```

<br>
<br>

#### ZIP

Download the package from github and extract files to your desired location.

In this case you have to inlcude **loader.php** file to you PHP script:

```php
<?php

include '{/path/to/fsairlines-php-integration}/loader.php';
```

<br>
<br>

### Usage

The usage is simple as possible.

1. Create connector with configuration data
2. Call operations (with needed parameters)

```php
<?php

$connector = new \FSAirlinesPhpIntegration\Connector(
    'virtual_airline_access_token',
    'virtual_airline_id'
);
```

To achieve **virtual_airline_access_token**, see documentation at https://wiki.fsairlines.net/index.php/XML-Interface-v2#Access_Restriction  
To achieve **virtual_airline_id**, you have to login to FSAirlines Crew Center and the ID is right behind your VA name in square brackets - VA NAME[12345] at the top of the page.

When the connector is created and initialized just call operations as needed and proceed data.
(See bellow for Operation List.)

```php
<?php

$connector = new \FSAirlinesPhpIntegration\Connector(
    'virtual_airline_access_token',
    'virtual_airline_id'
);

/** @var \FSAirlinesPhpIntegration\Model\ResponseInterface $response */
$response = $connector->operation()->getAircraftList();

if (
    !$response->isError() 
    && $response->getBody()['status'] === \FSAirlinesPhpIntegration\Model\ResponseInterface::STATUS_SUCCESS
) {
    $data = $response->getBody()['data'];
    // ... proceed data
}
```

**NOTE:** isError() method checks for HTTP errors, it means code 400 and above,
but the FSAirlines API returns OK (200) also when some error occurs and it is identified by STATUS.
The only status which the connector translate to code 404 is **NOT FOUND** status, so you have to do status check where it is needed by a operation. (See bellow.)

<br><br>

### Advanced Configuration and RAW Data

Basically, the connector works in Array format mode. It means all responded data comes back in a structured array.
But maybe, you want to process data by yourself. In this case, you can configure the connector
to return data in RAW JSON or in RAW XML.

```php
<?php

$connector = new \FSAirlinesPhpIntegration\Connector(
    'virtual_airline_access_token',
    'virtual_airline_id'
);
$connector->setRawData(true);
$connector->setRawDataFormat('xml');
// or $connector->setRawDataFormat('json');

/** @var \FSAirlinesPhpIntegration\Model\ResponseInterface $response */
$response = $connector->operation()->getAircraftList();

$stringXmlData = $response->getBody();
// or $stringJSONData = $response->getBody();
```
<br>

## RECOMMENDATION

**The number of requests per hour and per day is limited, so I strongly recommend to use any kind of cache to temporarily store static data (such as aircrafts or pilots) and proceed "real" requests to the FSAirlines API in some time intervals.**  
(Some examples how to cache data: https://www.web-development-blog.com/why-should-you-cache-your-php-website/)

<br>

## PUBLIC INTERFACES

<br>

### Connector


| Method             | Params                                 | Returns         | Note                          |
|--------------------|----------------------------------------|-----------------|-------------------------------|
| __construct()      | apiKey (string)<br> airlineId (string) | -               |                               |
| setRawData()       | rawData (bool)                         | -               |                               |
| setRawDataFormat() | rawDataFormat (xml / json)             | -               |                               | 
| setApiUrl()        | $apiUrl (string)                       | -               | Predefined, not necessary set | 
| operation()        |                        | OperationLoader |                               |  

<br>

### ResponseInterface

| Method             | Params | Returns        | Note                                     |
|--------------------|--------|----------------|------------------------------------------|
| getCode()       |        | integer        | HTTP Response Code                       |
| getStatus()       |        | string         | values: OK, ERROR                        |
| getBody()       |        | array / string | default: array; string when rawData=true |
| getMessage()       |        | string         | on error                                 |
| getContentType()       |        | string         |                                          |
| isError()       |        | bool           | if HTTP code is 400 and above            |

| Constant  | Value              |
|-----------|--------------------|
| STATUS_SUCCESS | SUCCESS            |
| STATUS_NOT_FOUND | NOT FOUND          |
| STATUS_FLIGHT_BOOKED | FLIGHT BOOKED      |
| STATUS_GROUNDED | GROUNDED           |
| STATUS_SUSPENDED | SUSPENDED          |
| STATUS_VA_INACTIVE | VA INACTIVE        |
| STATUS_INSUFFICIENT_FUNDS | INSUFFICIENT FUNDS |

<br>

### OperationLoader

This section describes operations which can be called over OperationLoader object.

<br>

#### Pilot Login

| Method             | Params                                  | Returns           | Note                                       |
|--------------------|-----------------------------------------|-------------------|--------------------------------------------|
| pilotLogin()       | username (string)<br> password (string) | ResponseInterface | See bellow for structure of responded data |

**Pilot Login - Responded Data Explanation**

|Parameter |	Meaning|
|----|----|
|token |	The pilots login token. |
|alt_code |	The alternate ICAO code of the airport they are currently located based on there default simulator. |
|budget |	The pilots current budget |
|default_sim |	The pilots default simulator. |
|location |	The FSA offical ICAO code of the airport the pilot is located. |
|name |	The pilots first name |
|pilot_id |	The id number of the pilot. |
|premium |	1 of the pilot is a premium member, 0 if not. |
|rank |	The code for the pilots rank within their VA |
|rank_id |	The id of the pilots rank within their VA |
|surname |	The pilots last or given name |
|va_id |	The ID of the pilots VA |
|va_status |	The pilots within there airline |
|va_user |	The pilots ID within their VA. |
|weightunit |	The pilots default unit of measure (kg or lb). |

<br>

#### Aircraft Data

| Method             | Params                                    | Returns        | Stauses (in body) | Data (in body) |
|--------------------|-------------------------------------------|----------------|-------------------|----------------|
| getAircraftData() | aircraftId (int)                          | ResponseInterface | SUCCESS, NOT FOUND | id, va_id, acdb_id, location, va_id, user_id, lease_id, fleet_id, status, value, registration, fuel, state, ac_name, stateeng1, stateeng2, stateeng3, stateeng4, stategear, statehull, img_path, pax_economy, pax_business, pax_first, config_name |
| getAircraftDBData() | aircraftDBId (int)                        | ResponseInterface | SUCCESS, NOT FOUND | id, manufacturer, type, icao, passengers, price, fuel, dow, mtow, speed, engines, cargo, mzfw, market_only, range |
| getAircraftDBList() |                                           | ResponseInterface | SUCCESS, NOT FOUND | id, manufacturer, type, icao |
| getAircraftList() |                                           | ResponseInterface | SUCCESS, NOT FOUND | id, acdb_id, icao, value, location, registration, state, ac_name, status, fleet_id, fuel |
| getAircraftStats() | aircraftId (int)                          | ResponseInterface | SUCCESS, NOT FOUND | flights, hours, distance |
| getFleetAircraftList() | fleetId (int)                             | ResponseInterface | SUCCESS, NOT FOUND | id, acdb_id, icao, value, location, registration, state, ac_name, status, fleet_id, fuel |
| getFleetList() |                                           | ResponseInterface | SUCCESS, NOT FOUND | id, name |
| getFleetStats() |                                           | ResponseInterface | SUCCESS, NOT FOUND | id, flights, hours, distance, last, fuel_used, profit, cargo_kg, pax |
| getPeriodFleetStats() | fromTimestamp (int)<br> toTimestamp (int) | ResponseInterface | SUCCESS, NOT FOUND | id, flights, hours, distance, last, fuel_used, profit, cargo_kg, pax |

<br>

#### Airport Data

| Method             | Params        | Returns        | Stauses (in body) | Data (in body) |
|--------------------|---------------|----------------|-------------------|----------------|
| getAirportData() | icao (string) | ResponseInterface | SUCCESS, NOT FOUND | id, name, iata, icao, city, country, la_g, la_p, la_s, la_d, lat, lo_g, lo_p, lo_s, lo_d, lon, altitude, length, fuel, size |
| getAirportList() |               | ResponseInterface | SUCCESS, NOT FOUND | icao, name, city, country, fuel, lat, lon |

<br>

#### Airline Data

| Method             | Params                            | Returns        | Stauses (in body) | Data (in body) |
|--------------------|-----------------------------------|----------------|-------------------|----------------|
| getAirlineData() | id (string) (=virtual_airline_id) | ResponseInterface | SUCCESS, NOT FOUND | id, name, base, code, budget, homepage, logo_l, logo_s, price (deprecated, will be removed in next release), reputation, pilotcharge, multiplier, mission |
| getAirlineStats() |                                   | ResponseInterface | SUCCESS, NOT FOUND | id, flights, rating, hours, distance, last, fuel_used, pax, cargo_kg |
| getCountryStats() | country (string) (eg: Germany)    | ResponseInterface | SUCCESS, NOT FOUND | va_name, id, flights, rating hours, profit, distance, last, fuel_used, pax, cargo_kg |
| getRankList() |     | ResponseInterface | SUCCESS, NOT FOUND | id, name, short, settings, pilots, aircrafts, fleet, flights, partnerships, advertisements, fleet_id |

<br>

#### Financial Data

| Method             | Params | Returns        | Stauses (in body) | Data (in body) |
|--------------------|--------|----------------|-------------------|----------------|
| getLast10Transactions() |        | ResponseInterface | SUCCESS, NOT FOUND | ts, value, reason |
| getNegTransactionSums() |        | ResponseInterface | SUCCESS, NOT FOUND | value, reason |
| getPosTransactionSums() |        | ResponseInterface | SUCCESS, NOT FOUND | value, reason |

<br>

#### Flight Data

| Method                           | Params                                                  | Returns        | Stauses (in body) | Data (in body) |
|----------------------------------|---------------------------------------------------------|----------------|-------------------|----------------|
| getActiveFlights()               |                                                         | ResponseInterface | SUCCESS, NOT FOUND | departure, arrival, passengers, cargo, user_id, ac_id, flightstate, timestamp, number, lon, lat, pax_economy, pax_business, pax_first |
| getBookedFlights()               |                                                         | ResponseInterface | SUCCESS, NOT FOUND | departure, arrival, passengers, cargo, user_id, ac_id, number, pax_economy, pax_business, pax_first |
| getFlightReports()               | days (int) (opt)<br> count (int) (opt)                  | ResponseInterface | SUCCESS, NOT FOUND | id, dep, arr, pln_arr, ts, pax, ac_type, distance, rating, salary, income, pilot_id, pic, pid, fuel_used, flighttype, hours, ac_id, number, deptime, arrtime, pln_deptime, pln_arrtime, route_id, va_id, va, pax_economy, pax_business, pax_first |
| getFlightReportsByPilotId()      | pilotId (int)<br> days (int) (opt)<br> count (int) (opt)      | ResponseInterface | SUCCESS, NOT FOUND | id, dep, arr, pln_arr, ts, pax, ac_type, distance, rating, salary, income, pilot_id, pic, pid, fuel_used, flighttype, hours, ac_id, number, deptime, arrtime, pln_deptime, pln_arrtime, route_id, va_id, va, pax_economy, pax_business, pax_first |
| getFlightReportsByAircraftId()   | aircraftId (int)<br> days (int) (opt)<br> count (int) (opt)   | ResponseInterface | SUCCESS, NOT FOUND | id, dep, arr, pln_arr, ts, pax, ac_type, distance, rating, salary, income, pilot_id, pic, pid, fuel_used, flighttype, hours, ac_id, number, deptime, arrtime, pln_deptime, pln_arrtime, route_id, va_id, va, pax_economy, pax_business, pax_first |
| getFlightReportsByAircraftDBId() | aircraftDBId (int)<br> days (int) (opt)<br> count (int) (opt) | ResponseInterface | SUCCESS, NOT FOUND | id, dep, arr, pln_arr, ts, pax, ac_type, distance, rating, salary, income, pilot_id, pic, pid, fuel_used, flighttype, hours, ac_id, number, deptime, arrtime, pln_deptime, pln_arrtime, route_id, va_id, va, pax_economy, pax_business, pax_first |
| getReportDetail() | reportId (int)                                          | ResponseInterface | SUCCESS, NOT FOUND | id, ac_type, ac_id, pic, pilot_id, number, dep, pln_arr, arr, deptime, loc_deptime, arrtime, loc_arrtime, hours, ts, flightstate, rating, ratingreasons, distance, pax, ticket, crew, salary, fuelprice, fuel_bought, fuel_used, profit, version, simrate, multiplier, bonus, cargo, cargo_kg, flighttype, comment, cheat, vs, pax_economy, pax_business, pax_first, ticket_business, ticket_first, fuel_start, fuel_dep, fuel_takeoff, fuel_land, fuel_finish, ticket_factor, interface, simversion, os |
| getRouteData() | routeId (int)                                           | ResponseInterface | SUCCESS, NOT FOUND | id, va_id, cs_vaid, number, dep, arr, deptime, arrtime, simrate, days, price, state, flighttype, acdb_list, ac_id, remarks, route, limit_pax, limit_cargo |
| getRouteList() |                                                         | ResponseInterface | SUCCESS, NOT FOUND | id, number, dep, dep_country, arr, arr_country, deptime, arrtime, simrate, days, price, state, flighttype, acdb_list, ac_id |

<br>

#### Pilot Data

| Method                | Params                                    | Returns        | Stauses (in body) | Data (in body) |
|-----------------------|-------------------------------------------|----------------|-------------------|----------------|
| getPeriodPilotStats() | fromTimestamp (int)<br> toTimestamp (int) | ResponseInterface | SUCCESS, NOT FOUND | id, flights, rating, hours, distance, last, fuel_used, profit, cargo_kg, pax |
| getPilotData() | pilotId (int)                             | ResponseInterface | SUCCESS, NOT FOUND | id, name, surname, user, va_user, rank_id, location, budget, lastactive, active, sigac, timezone, weightunit, language, msgmail, rank, flights, rating, hours, distance, pax, cargo_kg, picture |
| getPilotHours() | pilotId (int)                             | ResponseInterface | SUCCESS, NOT FOUND | id, manufacturer, type, icao, hours |
| getPilotList() |                                           | ResponseInterface | SUCCESS, NOT FOUND | id, name, surname, user, va_user, rank_id, location, last_active, status, budget |
| getPilotRatings() | pilotId (int)                             | ResponseInterface | SUCCESS, NOT FOUND | id, training, manufacturer, type |
| getPilotStats() |                                           | ResponseInterface | SUCCESS, NOT FOUND | id, flights, rating, hours, distance, last, fuel_used, profit, cargo_kg, pax |
| getPilotStatus() | pilotId (int)                             | ResponseInterface | SUCCESS, NOT FOUND | ac_id, route_id, departure, arrival, dep_time, dist, duration, status, lon, lat, flightstate, passengers, income, ticket, timestamp, cargo, multiplier, flighttype |

<br>

#### Flight Booking

| Method                | Params                                                                     | Returns        | Stauses (in body) | Data (in body) |
|-----------------------|----------------------------------------------------------------------------|----------------|-------------------|---------------|
| bookFlight() | pilotId (int)<br> loginToken (string)<br> routeId (int)<br> aircraftId (int) | ResponseInterface | SUCCESS, NOT FOUND, FLIGHT BOOKED, GROUNDED, SUSPENDED, VA INACTIVE | success, message, codeshare, codeshare_msg |
| cancelFlight() | pilotId (int)<br> loginToken (string)                                      | ResponseInterface | SUCCESS, NOT FOUND | result, loss |
| getBookableRoutes() | pilotId (int)<br> loginToken (string)                                      | ResponseInterface | SUCCESS, NOT FOUND, FLIGHT BOOKED, GROUNDED, SUSPENDED, VA INACTIVE | number, dep, arr, deptime, arrtime, id, state, simrate, flighttype, training, price, list, ac_id |
| getBookableAircraft() | pilotId (int)<br> loginToken (string)<br>, routeId (int)                   | ResponseInterface | SUCCESS, NOT FOUND, FLIGHT BOOKED, GROUNDED, SUSPENDED, VA INACTIVE | type, registration, state, id, name, fuel |
| getBookStatus() | pilotId (int)                  | ResponseInterface | SUCCESS, NOT FOUND | status |

<br>

#### Miscellaneous User Functions

| Method                | Params                                               | Returns        | Stauses (in body)    | Data (in body) |
|-----------------------|------------------------------------------------------|----------------|----------------------|---------------|
| getPilotID() | username (string)<br> loginToken (string)            | ResponseInterface | SUCCESS, NOT FOUND   | id |
| getPrivacyPolicy() |                                                      | ResponseInterface | SUCCESS, NOT FOUND   | policy |
| getTransferCost() | departure (string)<br> arrival (string)<br> (icao codes) | ResponseInterface | SUCCESS, NOT FOUND   | cost |
| transferPilot() | pilotId (int)<br> loginToken (string)<br> icao (string) | ResponseInterface | SUCCESS, NOT FOUND, INSUFFICIENT FUNDS | cost |
| getDistance() | icaoFrom (string)<br> icaoTo (string)                | ResponseInterface | SUCCESS, NOT FOUND   | distance |
| getMetar() | icao (string)                    | ResponseInterface | SUCCESS, NOT FOUND   | metar |

<br>

#### Package Functions

| Method                | Params           | Returns        | Stauses (in body)    | Data (in body)      |
|-----------------------|------------------|----------------|----------------------|---------------------|
| getAirportPackageSummary() | icao (string)    | ResponseInterface | SUCCESS, NOT FOUND   | See examples bellow |
| getVaPackageSummary() |                  | ResponseInterface | SUCCESS, NOT FOUND   | See examples bellow |
| getAircraftPackages() | aircraftId (int) | ResponseInterface | SUCCESS, NOT FOUND   | See examples bellow |
| getCenterPackages() | centerId (int)   | ResponseInterface | SUCCESS, NOT FOUND   | See examples bellow |

<br>

#### Package Function - Response Examples

**getAirportPackageSummary**

```json
{
    "status": "SUCCESS",
    "data": {
        "arr": {
            "EDDK": {
                "100000": 1,
                "200": 12,
                "2000": 2,
                "bearing": 29.528874983699,
                "city": "Cologne-Bonn",
                "distance": 4872.3920956341,
                "total_kg": 106400
            },
            "KBFL": {
                "200": 16,
                "40": 310,
                "bearing": 128.34209940912,
                "city": "Bakersfield",
                "distance": 207.19199031933,
                "total_kg": 15600
            },
        }
    }
}
```

**getVaPackageSummary**

```json
{
    "status": "SUCCESS",
    "data": {
        "aircraft": [
            {
                "ac_id": 129691,
                "earliest_ts": 1622293737,
                "location": "EDDF",
                "packages": 13,
                "registration": "D-AOGT",
                "size_kg": 26000
            }
        ],
        "centers": [
            {
                "center_id": 4347,
                "description": "Himalayan Transport",
                "earliest_ts": 1621459008,
                "location": "VNKT",
                "packages": 82,
                "size_kg": 4080
            }
        ]
    }
}
```

**getAircraftPackages, getCenterPackages**

```json
{
    "status": "SUCCESS",
    "data": [
        {
            "ac_id": 129691,
            "arr": "SBGL",
            "arr_city": "Rio De Janeiro",
            "center_id": null,
            "created_ts": 1620830486,
            "delivered": false,
            "dep": "EDDF",
            "fleet_id": 72303,
            "id": 302216085,
            "location": "EDDF",
            "mult": 10,
            "package_type": 0,
            "payment": 59281,
            "payment_fact": null,
            "pilot_id": 98096,
            "size_kg": 2000,
            "start_ts": 1622293737,
            "updated_ts": 1620830486
        },
    ]
}
```

<br>

### Params Explanation

Operations may be called with params and here are the meanings of them:

| Parameter          | 	Meaning                                                                                                         |
|--------------------|------------------------------------------------------------------------------------------------------------------|
| aircraftId         | 	ID of the aircraft. Is part of the data received from other functions (e.g. getAircraftList()) as ac_id.        |
| aircraftDBId       | 	ID of the aircraft type. Is part of the data received from other functions (e.g. getAircraftList()) as acdb_id. |
| arrival            | 	ICAO code of the arrival airport.                                                                               |
| count              | 	Number past flights which should be displayed.                                                                  |
| country            | 	Name of the country (e.g. Germany).                                                                             |
| days               | 	Number of past days from now which should be displayed.                                                         |
| departure          | 	ICAO code of the departure airport.                                                                             |
| fleetId            | 	ID of the fleet. Is part of the data received from other functions as fleet_id.                                 |
| fromTimestamp      | 	UNIX timestamp of the date where the listing should start.                                                      |
| icao               | 	ICAO code of the airport.                                                                                       |
| pilotId            | 	ID of the pilot. Is part of the data received from other functions as pilot_id.                                 |
| reportId           | 	ID of the report. Is part of the data received from other functions as report_id.                               |
| toTimestamp        | 	UNIX timestamp of the date where the listing should end.                                                        |
| username           | 	Username of the pilot.                                                                                          |
| loginToken         | 	Login token created by the pilotLogin function as token.                                                        |
