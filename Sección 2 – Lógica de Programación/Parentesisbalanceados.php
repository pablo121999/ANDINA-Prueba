<?php
function parentesisBalanceados($cadena) {
    $contador = 0;

    // Recorremos cada carácter
    for ($i = 0; $i < strlen($cadena); $i++) {
        if ($cadena[$i] === "(") {
            $contador++;
        } elseif ($cadena[$i] === ")") {
            $contador--;
            // Si en algún momento hay más ")" que "(", no está balanceado
            if ($contador < 0) {
                return false;
            }
        }
    }

    // Si el contador termina en 0, está balanceado
    return $contador === 0;
}

// Ejemplos de uso
var_dump(parentesisBalanceados("(a + b) * (c + d)")); // true
var_dump(parentesisBalanceados("(a + b * (c + d)"));  // false
var_dump(parentesisBalanceados(")("));                // false

// comando para ejecutar en la terminal
// php Parentesisbalanceados.php
?>
