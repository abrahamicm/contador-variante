<?php

/**
 * Plugin Name: Corefix Contador Variable
 * Plugin URI: https://www.example.com
 * Description: Este plugin permite mostrar un contador variable en una página mediante un shortcode.
 * Version: 1.0
 * Author: Tu nombre
 * Author URI: https://www.example.com
 * Text Domain: corefix-contador
 * Domain Path: /languages
 */
function calcularProgreso($fechaInicio, $fechaFin, $valorInicio, $valorFin) {
    $fechaActual = new DateTime();
    $tiempoTotal = $fechaFin->getTimestamp() - $fechaInicio->getTimestamp();
    $tiempoTranscurrido = $fechaActual->getTimestamp() - $fechaInicio->getTimestamp();
    $progresoTiempo = $tiempoTranscurrido / $tiempoTotal;
    $valorActual = $valorInicio + ($valorFin - $valorInicio) * $progresoTiempo;
    return array(
      'fechaActual' => $fechaActual,
      'tiempoTotal' => $tiempoTotal,
      'tiempoTranscurrido' => $tiempoTranscurrido,
      'progresoTiempo' => $progresoTiempo,
      'valorActual' => round($valorActual)
    );
  }