<?php

/**
 * Created by PhpStorm.
 * User: Gear
 * Date: 06.07.2018
 * Time: 17:33
 */
class Db
{
    public static  function getConnection(){
        $paramsPath = ROOT.'/config/db_params.php';
        $params = include ($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        return $db;
    }
}