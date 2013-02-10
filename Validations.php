<?php
class Validations
{

    public static function validateStatus($status)
    {

        if (!(assert($status == "OK"))) {
            return false;
        }
        return true;
    }

    public static function validateStatusCode($statusCode)
    {
        if (!(assert($statusCode == "200"))) {
            return false;
        }
        return true;
    }

    public static function validateBookResponse($jsonObject)
    {
        $errorMsg = "";
        $kind = $jsonObject['kind'];
        $totalItems = $jsonObject['totalItems'];

        if ($totalItems == 0) {
            $errorMsg = "No items found.";
            return $errorMsg;
        }

        $errorMsg = Validations::validateNode($currentNode);

        if ($errorMsg != "") {
            return $errorMsg;
        }

        // Additional validation can be added here


        return $errorMsg;
    }

   

    

function is_empty($var)
{
    if ($var === null) {
        return true;
    }

    if (is_array($var) && (count($var) <= 0)) {
        return true;
    }
    else if (is_string($var) && (strlen(trim($var)) <= 0)) {
        return true;
    }

    return false;
}
}