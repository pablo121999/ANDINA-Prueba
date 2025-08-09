<?php
function palabraMasLarga($cadena) {
    // Dividir la cadena en palabras usando espacios como separador
    $palabras = explode(" ", $cadena);

    $masLarga = "";
    foreach ($palabras as $palabra) {
        // Eliminar signos de puntuación por si vienen pegados
        $palabraLimpia = preg_replace("/[^\p{L}\p{N}]/u", "", $palabra);

        if (strlen($palabraLimpia) > strlen($masLarga)) {
            $masLarga = $palabraLimpia;
        }
    }

    return $masLarga;
}

// Ejemplo de uso
$texto = "El desarrollo de software requiere paciencia y creatividad";
echo "La palabra más larga es: " . palabraMasLarga($texto);

// comando para ejecutar en la terminal
// php Palabramaslarga.php
?>
