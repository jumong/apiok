<?php

require_once("Imports.php");
    
TestBook::main();

class TestBook {

    public static $items;


    function setup(){

        
    }

    function teardown(){

        
    }

    function testSearch(){
            $this->items = Http::doGET(Http::constructURL("volumes?q=search+terms"));

            $jsonObject = $this->items;

            if(count($jsonObject) == 0){
                Status::$failed = Status::$failed+1;
                array_push(Status::$error,"[testSearch]: Empty json object");
                return;
            }

            foreach($jsonObject as $key=>$value){

                if($key == "STATUS"){
                    $result = Validations::validateStatus($value);
                    if(!$result){
                        Status::$failed=Status::$failed+1;
                        array_push(Status::$error,"[testSearch]: Expected STATUS OK observed $value");
                        return;
                    }
                }
                elseif($key == "STATUS_CODE"){
                   $result = Validations::validateStatusCode($value);
                   if(!$result){
                       Status::$failed = Status::$failed+1;
                        array_push(Status::$error,"[testSearch]: Expected STATUS_CODE 200 observed $value");
                        return;
                   }
                }
                elseif($key == "RESPONSE"){
                    $result = Validations::validateBooksResponse($jsonObject);
                    if($result!=""){
                        Status::$failed = Status::$failed+1;
                        array_push(Status::$error,"[testSearch]: ".$result);
                        return;
                    }
                }
                
                }
               

                Status::$passed = Status::$passed+1;
        }

    static function main(){
            
            
            $testBook = new TestBook();
            $testBook->setup();
            $class = new ReflectionClass('TestBook');
                       $methods = $class->getMethods();
                        foreach($methods as $method){

                            if(strstr($method->name,"test")){
                                try{

                                   $f = $method->name;
                                   $testBook->$f();                 

                                   }catch(Exception $e){
                                   Status::$exception = Status::$exception + 1;
                                   array_push(Status::$error, $e);
                                }
                            }
                        }
            Status::getStatus();
            Status::flushStatus();
            $testBook->teardown();
            
        

        }

}
