<?php

class Http {

	public static function constructURL($uri,$params=array()) {
		$url = Globals::getApiurl();
        $url .= $uri;
        foreach ($params as $key=>$value) {
            if (is_array($value) || is_object($value)) {
                $params[$key] = json_encode($value);
            }
        }
        if (!empty($params)) $url .= "?".http_build_query($params);
        return $url;
    }

	
    public static function doGET($url) {
		echo "GET $url\n";
		$ch = curl_init($url);
		return self::doCURL($ch);
    }

    public static function doPOST($url,$data=null) {
		echo "POST $url\n";
		if (is_array($data)) $data = json_encode($data);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		return self::doCURL($ch);
    }

    public static function doPUT($url,$data=null) {
		echo "PUT $url\n";
		if (is_array($data)) $data = json_encode($data);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		return self::doCURL($ch);
    }

    public static function doDELETE($url) {
		echo "DELETE $url\n";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		return self::doCURL($ch);
    }

    public static function doCURL($ch) {

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, Globals::$apiConnectionTimeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, Globals::$apiOperationTimeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));

        $json = curl_exec($ch);
        $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        if (empty($json)) {
            $response = "";
        } else {
            //var_dump("I am here *****".$json);
            $response = json_decode($json,true);
            
        }

        if (empty($httpCode)) throw new Exception("Connection failed",500);
        if ($response === null) throw new Exception("Json parsing failed",500);
        if ($httpCode != 200) throw new Exception($response["ERROR_CODE"].": ".$response["ERROR_MSG"],$httpCode);

        return $response;
    }

}
