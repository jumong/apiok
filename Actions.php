<?php
require_once("Globals.php");

class Actions {

    public static function login($emailId,$password){
      $response = Http::doGET(Http::constructURL("/Session/login",array("emailId"=>$emailId,"passwd"=>$password)));
      return $response;
    }

    public static function logout(){
      $response =  Http::doGET(Http::constructURL("/Session/logout"));
      return $response;
    }
}
