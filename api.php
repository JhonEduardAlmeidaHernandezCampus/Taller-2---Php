<?php

header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true); 
$_METHOD = $_SERVER["REQUEST_METHOD"];                        

function validarNumero(float $numero){
    if (intval($numero) == floatval($numero)) {
        $calculo = $numero % 2;
        $mensajeParImpar = ($calculo == 0) ? "PAR." : "IMPAR.";
        $mensajeMayorDiez = ($numero > 10) ? "El número $numero es mayor a 10, y es " : "";
        
        return $mensajeMayorDiez . "" . $mensajeParImpar;
    } else {
        return "Error!! El dato ingresado es incorrecto";
    }     
}

// --------------------------------------------------------------------------
try {
    $res = match($_METHOD){
        "POST" => validarNumero(...$_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" No se puede ejecutar esta operacion
        STRING,
    };                                                                       
} catch (\Throwable $th) {
    $res = "Error!";
}
// --------------------------------------------------------------------------

// -----------------------------------------------
echo $res;
// -----------------------------------------------

?>