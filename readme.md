# Php Zomato Api Client
Zomato api client written in PHP. Supports [Zomato APIv2.1](https://developers.zomato.com/documentation).

Installation
----------
Just use composer.
```sh
composer require darkling/php-zomato-client
```

Usage
----------
```php
// Create request
$request = new RestaurantRequest(16506740); // restaurant ID
// OR
//$request = RestaurantRequest::createFromParameters(['res_id' => 16506740]);
// Name of parameters must respect name of parameters in zomato api documentation

// Create client
// You can choose from three possible output options (JSON_STRING, JSON_ARRAY, JSON_STD_CLASS)
$client = new ZomatoClient('userApiKey', ResponseOption::get(ResponseOption::JSON_STRING));

// Send request and get response
$response = $client->send($request);

// Handle response
if ($response->isOk()) {
	var_dump($response->getData());
} else {
	var_dump($response->getStatusCode());
	var_dump($response->getReasonPhrase());
}
```

Requests
----------
List of available requests:
* /categories Get list of Categories -> *Not implemented*
* /cities Get city details -> *Not implemented*
* /collections Get Zomato collections in a city -> *Not implemented*
* /cuisines Get list of all cuisines in a city -> *Not implemented*
* /establishments Get list of restaurant types in a city -> *Not implemented*
* /geocode Get location details based on coordinates -> *Not implemented*
* /location_details Get Zomato location details -> *Not implemented*
* /locations Search for locations -> *Not implemented*
* /dailymenu Get daily menu of a restaurant -> **DailyMenuRequest**
* /restaurant Get restaurant details -> **RestaurantRequest**
* /reviews Get restaurant reviews -> **ReviewsRequest**
* /search Search for restaurants -> **SearchRequest**

If you need to use some of the request which is not currently implemented, you are welcome to send PR :-)

Nette
----------
If you are looking for integration to [Nette Framework](https://nette.org/) just use this package [daaarkling/nette-zomato-client](https://github.com/Daaarkling/nette-zomato-client).

Licence
----------
New BSD License
