# Geo IP
Fast IP address to country code lookup - Extension-less, automatic updates, and fast JSON tree lookup 

## Introduction

A PHP package to lookup the country of a given IP address (IPv4 supported, IPv6 on the way).

This library focuses on performance and simplicity, at the cost of slightly less precision. It is designed to return an ISO country for a given IP address, and does it well. It does not provide precise locations (such as region or city) by design. 

This library uses [Ayesh/Geo-IP-Database](https://github.com/Ayesh/Geo-IP-Database), an automated repository that publishes database updates weekly at most. The database is entirely a list of flag JSON files, that maps IP ranges to a country code.

This library does not require storing a binary data file, or HTTP requests, and thus is extremely fast.

> Note that the data may not be as accurate as a full database. Autofilling the country field in a form, or redirecting a user to a regional site are some of the ideal use case. Pinpointing the precise user location to find hot singles in the area is pushing it too much. 


## Automatic updates
This library depends on [Ayesh/Geo-IP-Database](https://github.com/Ayesh/Geo-IP-Database) package, that provides the JSON files list. 

Automatic updates to the `ayesh/geo-ip-database` package means an update to the database. They are in the format of `v1.0.YYYYMMDD`.

Occassional `composer update` will automatically trigger database updates. 



## Installation

Install this library with the following command. Alternately, it is possible to manually edit the `composer.json` file and add `ayesh/geo-ip` package as well. 

```bash
composer require ayesh/geo-ip
```

## Usage

This library provides a `\Ayesh\GeoIP\GeoIPLookup` class. Use the Composer autoloader (highly recommended), or manually `require` `src/GeoIPLookup.php` file. 


### Automatic database discovery

```php

use Ayesh\GeoIP\GeoIPLookup;

$geoip = GeoIPLookup::createFromDefaultDatabase();
$geoip->lookup('8.8.8.8'); // "US"
$geoip->lookup('123.19.12.50'); // "VN"
```

The `createFromDefaultDatabase` static method creates a `GeoIPLookup` by setting the JSON data directory to the default `ayesh/geo-ip-database` location in a standard Composer installation (`vendor/ayesh/geo-ip-database/data`). 

### Manual database path

```php
use Ayesh\GeoIP\GeoIPLookup;

$geoip = new GeoIPLookup('path/to/json/directory');
$geoip->lookup('8.8.8.8'); // "US"
$geoip->lookup('123.19.12.50'); // "VN"
```

## Contributions and Issues

Feel free to open a PR or an issue for any contributions or support questions.

## Database Source

This library makes use of `ayesh/geo-ip-database`, which in turn uses GeoLite2 data created by MaxMind, available from [https://www.maxmind.com](https://www.maxmind.com). 

This library itself is MIT licensed. However, note that the MaxMind database is distributed under CC-BY-NC-SA-4.0.
