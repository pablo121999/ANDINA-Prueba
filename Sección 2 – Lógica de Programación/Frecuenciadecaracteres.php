<?php
function frecuenciaCaracteres($cadena) {
    // Convertimos todo a minúsculas para no diferenciar mayúsculas de minúsculas
    $cadena = mb_strtolower($cadena, 'UTF-8');

    // Quitamos espacios
    $cadena = str_replace(" ", "", $cadena);

    $frecuencia = [];

    // Recorremos cada carácter
    for ($i = 0; $i < mb_strlen($cadena, 'UTF-8'); $i++) {
        $caracter = mb_substr($cadena, $i, 1, 'UTF-8');
        if (!isset($frecuencia[$caracter])) {
            $frecuencia[$caracter] = 0;
        }
        $frecuencia[$caracter]++;
    }

    return $frecuencia;
}

// Ejemplo de uso
$texto = "Hola Mundo";
$resultado = frecuenciaCaracteres($texto);

print_r($resultado);

// comando para ejecutar en la terminal
// php Frecuenciadecaracteres.php
?>
