<?php

header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true); 
$_METHOD = $_SERVER["REQUEST_METHOD"];                        

function calcularVoltaje(float $resistencia, float $intensidad){
    return $resistencia * $intensidad;    
}

// --------------------------------------------------------------------------
try {
    $res = match($_METHOD){
        "POST" => calcularVoltaje(...$_DATA),
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
    "Voltaje" => $res
];

echo json_encode($respuesta, JSON_PRETTY_PRINT);
// -----------------------------------------------

?>