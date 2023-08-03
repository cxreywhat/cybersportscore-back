<?php

namespace App\Services;

class OpenDotaService
{
    private static $heroes = null;
    private static $items = null;

    /**
     * @param $matchID
     * @return mixed
     */
    public static function getMatchData($matchID)
    {
        return self::request('GET', '/api/matches/' . $matchID);
    }

    public static function getJobInfo($jobId)
    {
        return self::request('GET', '/api/request/' . $jobId);
    }

    /**
     * @param $matchID
     * @return mixed
     */
    public static function parseRequest($matchID)
    {
        return self::request('POST', '/api/request/' . $matchID);
    }

    private static function getHeroesConstants()
    {
        return self::$heroes = self::request('GET', '/api/constants/heroes');
    }

    private static function getItemsConstants()
    {
        return self::$items = self::request('GET', '/api/constants/items');
    }

    public static function getHeroLocalizedNameById($heroID)
    {
        if (!self::$heroes) self::getHeroesConstants();

        return self::$heroes[$heroID]['localized_name'] ?? null;
    }

    public static function getHeroNameById($heroID)
    {
        if (!self::$heroes) self::getHeroesConstants();

        return self::$heroes[$heroID]['name'] ?? null;
    }

    public static function getHeroIdByName($name)
    {
        if (!self::$heroes) self::getHeroesConstants();

        foreach (self::$heroes as $hero) {
            if ($hero['name'] == $name) {
                return $hero['id'];
            }
        }

        return null;
    }

    public static function getHeroImgById($heroID)
    {
        if (!self::$heroes) self::getHeroesConstants();

        return self::$heroes[$heroID]['img'] ?? null;
    }

    public static function getItemNameById($itemId)
    {
        if (!self::$items) self::getItemsConstants();

        foreach (self::$items as $item) {
            if ($item['id'] == $itemId) {
                return $item['dname'];
            }
        }

        return null;
    }

    public static function getItemTitleById($itemId)
    {
        if (!self::$items) self::getItemsConstants();

        foreach (self::$items as $title => $item) {
            if ($item['id'] == $itemId) {
                return $title;
            }
        }

        return null;
    }

    public static function getItemPicById($itemId)
    {
        if (!self::$items) self::getItemsConstants();

        foreach (self::$items as $item) {
            if ($item['id'] == $itemId) {
                return $item['img'];
            }
        }

        return null;
    }

    private static function request($type, $path)
    {
        $schema = 'http';
        $mock_url = sprintf('https://%s%s', 'odota.esnadm.com', $path);

        $headers = [
            'ms-target' => env('OPEN_DOTA_API_HOST'),
            'ms-target-scheme' => $schema,
            'ms-target-port' => 5000,
            'ms-history-ttl' => 3600,
            'ms-history-size' => 100,
            'ms-env' => env('APP_ENV'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
        $headers = array_map(static function($value, $name) {
            return sprintf('%s: %s', $name, $value);
        }, $headers, array_keys($headers));

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $mock_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
