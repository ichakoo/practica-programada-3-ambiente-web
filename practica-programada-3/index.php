<?php
// Practica Programada #3 Isaac Lobo Arroyo

// arreglo transacciones
$transacciones = array();

// funcion para registrar transaccion
function registrarTransaccion($id, $descripcion, $monto)
{
    global $transacciones;

    $transaccion = array(
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    );

    array_push($transacciones, $transaccion);
}

// funcion para generar estado de cuenta
function generarEstadoDeCuenta()
{
    global $transacciones;

    // sumar todas las transacciones / monto de contado
    $montoContado = 0;
    foreach ($transacciones as $t) {
        $montoContado = $montoContado + $t["monto"];
    }

    // calculos
    $interes = $montoContado * 0.026;              // 2.6% de interes
    $montoConInteres = $montoContado + $interes;   // monto con interes
    $cashBack = $montoContado * 0.001;             // 0.1% del monto de contado
    $montoFinal = $montoConInteres - $cashBack;    // monto final a pagar

    // mostrar en pantalla
    echo "<h1>Estado de Cuenta</h1>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Descripcion</th><th>Monto</th></tr>";
    foreach ($transacciones as $t) {
        echo "<tr>";
        echo "<td>" . $t["id"] . "</td>";
        echo "<td>" . $t["descripcion"] . "</td>";
        echo "<td>" . number_format($t["monto"], 2, ",", ".") . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<p>Monto total de contado: " . number_format($montoContado, 2, ",", ".") . "</p>";
    echo "<p>Monto total con interes (2.6%): " . number_format($montoConInteres, 2, ",", ".") . "</p>";
    echo "<p>Cash back (0.1%): " . number_format($cashBack, 2, ",", ".") . "</p>";
    echo "<p><strong>Monto final a pagar: " . number_format($montoFinal, 2, ",", ".") . "</strong></p>";

    // generar archivo txt
    $texto = "ESTADO DE CUENTA\n";
    $texto = $texto . "----------------------------------\n";
    foreach ($transacciones as $t) {
        $texto = $texto . "ID: " . $t["id"] . " | " . $t["descripcion"] . " | " . number_format($t["monto"], 2, ",", ".") . "\n";
    }
    $texto = $texto . "----------------------------------\n";
    $texto = $texto . "Monto total de contado: " . number_format($montoContado, 2, ",", ".") . "\n";
    $texto = $texto . "Monto total con interes (2.6%): " . number_format($montoConInteres, 2, ",", ".") . "\n";
    $texto = $texto . "Cash back (0.1%): " . number_format($cashBack, 2, ",", ".") . "\n";
    $texto = $texto . "Monto final a pagar: " . number_format($montoFinal, 2, ",", ".") . "\n";

    file_put_contents("estado_cuenta.txt", $texto);

    echo "<p>Se genero el archivo estado_cuenta.txt</p>";
}

// datos quemados de transacciones
registrarTransaccion(1, "Supermercado", 100000);
registrarTransaccion(2, "Gasolina", 20000);
registrarTransaccion(3, "Restaurante", 45550);
registrarTransaccion(4, "Farmacia", 9200);
registrarTransaccion(5, "Ropa", 215350);

// generar el estado de cuenta
generarEstadoDeCuenta();
?>
