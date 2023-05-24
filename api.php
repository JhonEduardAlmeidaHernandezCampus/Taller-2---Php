<?php

header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true); 
$_METHOD = $_SERVER["REQUEST_METHOD"];                        

function calcMayor($arg){
    if(count($arg) > 0 && count($arg) <= 3){
        $sum = 0;
        $position = 0;
        for ($i=0; $i < count($arg); $i++) {
            if (!is_numeric($arg[$i]["edad"] || !is_string($arg[$i]["nombre"]))) {
                return "Error!";
            }

            $edad = (int) $arg[$i]["edad"];
            if ($edad >= $sum) {
                $sum = $edad ;
                $position = $i;
            }
        }
        return $arg[$position];
    } else{
        return "Error!!";
    }
}

// --------------------------------------------------------------------------
try {
    $res = match($_METHOD){
        "POST" => calcMayor($_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" No se puede ejecutar esta operacion
        STRING,
    };                                                                       
} catch (\Throwable $th) {
    $res = "Error!";
}
// --------------------------------------------------------------------------

// -----------------------------------------------
$respuesta = (array) [
    "Datos" => $_DATA,
    "personaMayor" => $res
];

echo json_encode($respuesta, JSON_PRETTY_PRINT);
// -----------------------------------------------

?>