<?php
function fizzBuzzExtendido($inicio, $fin) {
    // Aseguramos que solo trabajamos con números positivos
    for ($i = max(1, $inicio); $i <= $fin; $i++) {
        if ($i % 3 === 0 && $i % 5 === 0) {
            echo "FizzBuzz\n";
        } elseif ($i % 3 === 0) {
            echo "Fizz\n";
        } elseif ($i % 5 === 0) {
            echo "Buzz\n";
        } else {
            echo $i . "\n";
        }
    }
}

// Ejecutar de 1 a 100
fizzBuzzExtendido(1, 100);

// comando para ejecutar en la terminal
// php FizzBuzzextendido.php
?>