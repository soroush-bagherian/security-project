<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Predis\Client;

class MonitoringController extends Controller
{
    public function index()
    {

        $keys = $this->getAllRedisKeys();
        $users = $this->getAllUser($keys);
        $pass = $this->getAllPass($keys);
        $country = $this->getAllCountries($keys);
        $combinationOfUserPass = $this->getCombinationOfUserPass($keys);


        $mostUser = array_count_values($users);
        arsort($mostUser);

        $mostPass = array_count_values($pass);
        arsort($mostPass);


        $mostCountry = array_count_values($country);
        arsort($mostCountry);


        $mostUserPass = array_count_values($combinationOfUserPass);
        arsort($mostUserPass);


        return view('dashboard/monitoring' ,compact(['mostUser','mostPass','mostCountry','mostUserPass']));
    }

    public function getAllRedisKeys()
    {
        $keys = null;

        $client = new Client();
        $keys = $client->keys('*');

        return $keys;
    }

    public function getAllUser($arr)
    {

        $users = array();

        foreach ($arr as $value) {
            array_push($users, explode("_", $value)[3]);
        }

        return $users;
    }

    public function getAllPass($arr)
    {
        $passwords = array();

        foreach ($arr as $value) {
            array_push($passwords, explode("_", $value)[4]);
        }

        return $passwords;
    }

    public function getAllCountries($arr)
    {
        $countries = array();

        foreach ($arr as $value) {
            array_push($countries, explode("_", $value)[5]);
        }

        return $countries;
    }

    public function getCombinationOfUserPass($arr)
    {
        $combination = array();

        foreach ($arr as $value) {
            $user = explode("_", $value)[3];
            $pass = explode("_", $value)[4];
            $user_pass = $user . '_' . $pass;
            array_push($combination, $user_pass);
        }

        return $combination;
    }
}
