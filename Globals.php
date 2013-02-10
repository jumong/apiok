<?php

 
class Globals {

	public static $apiurl = "https://www.googleapis.com/books/v1/";
	public static $apiConnectionTimeout = 0;
	public static $apiOperationTimeout = 0;

	
    public static function setApiurl($apiurl)
    {
        self::$apiurl = $apiurl;
    }

    public static function getApiurl()
    {
        return self::$apiurl;
    }

    public static function setVersionArray($versionArray)
    {
        self::$versionArray = $versionArray;
    }

    public static function getVersionArray()
    {
        return self::$versionArray;
    }
}
