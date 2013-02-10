<?php
 
class Status{

   public static $passed=0;
   public static $failed=0;
   public static $exception=0;
   public static $error = array("");

   public static function getStatus(){

      print "Test Passed : ".self::$passed."\n";
      print "Test Failed : ".self::$failed."\n";
      print "Test Exceptions : ".self::$exception."\n";
      if (count(self::$error)>0){

       foreach(self::$error as $key=>$value){
         print "$value "."\n";
       }
     }
           
   }

   public static function flushStatus(){

       self::$passed = 0;
       self::$failed = 0;
       self::$exception = 0;
       self::$error = array("");

   }
    
}
