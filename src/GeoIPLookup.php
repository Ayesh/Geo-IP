<?php

namespace Ayesh\GeoIP;

class GeoIPLookup {
    private string $data_dir;
    public function __construct(string $data_dir) {
        $this->data_dir = rtrim($data_dir, '/\\');
    }

    public static function createFromDefaultDatabase(): self {
        return new static(__DIR__ . '/../../Geo-IP-Database/data');
    }

    public function lookup(string $ip_address): ?string {
        $parts = explode('.', $ip_address, 2);
        $file = $this->data_dir . '/' . $parts[0] . '.json';
        $map = file_get_contents($file);
        $map = json_decode($map, true, 3, JSON_THROW_ON_ERROR);
        $find = ip2long('0.' . $parts[1]);
        $last = null;
        foreach ($map as $long_val => $code) {
            if ($find >= $long_val) {
                $last = $code;
                continue;
            }
            return $last;
        }

        return $last;
    }
}
