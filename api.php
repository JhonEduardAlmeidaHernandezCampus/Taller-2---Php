<?php

header("Content-Type:application/json");

$_DATA = json_decode(file_get_contents("php://input"), true); // Recoge todos los datos de los input
$_METHOD = $_SERVER["REQUEST_METHOD"];                        // Valida si el metodo es POST 

function promedio(float $nota1, float $nota2, float $nota3){
    $promedio = ($nota1 + $nota2 + $nota3)/3;

    return (array)[
        "prom"=> $promedio,
        "mensaje"=> ($promedio >= 3.9) ?"Becado" :"Estudie"
    ];
}

// --------------------------------------------------------------------------
try {
    $res = match($_METHOD){
        "POST" => promedio(...$_DATA),
        default => <<<STRING
        Methodo "${_METHOD}" No se puede ejecutar esta operacion
        STRING,
    };                                                                       // Valida si el metodo es POST
} catch (\Throwable $th) {
    $res = (array)[
        "prom"=> "Error!",
        "mensaje"=> "Error!"
    ];
}
// --------------------------------------------------------------------------

// -----------------------------------------------
$resuesta = (array) [
    "Estado" =>$res["mensaje"],
    "Datos" => $_DATA,                              // Se muestra la respuesta en un array en pantalla 
    "Promedio" => $res["prom"]
];
echo json_encode($resuesta, JSON_PRETTY_PRINT);
// -----------------------------------------------

?>