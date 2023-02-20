<?php
if (!defined('ABSPATH')) {
    exit;
}

function corefix_contador_shortcode($atts) {
    if (empty($atts['fecha_inicial']) || empty($atts['fecha_final'])) {
        return '<p>Error: se deben proporcionar la fecha inicial y la fecha final para mostrar el contador.</p>';
    }

    $atts = corefix_contador_parse_attributes($atts);
    $conteo_actual = corefix_contador_calcular_conteo_actual($atts);

    $shortcode_content = corefix_contador_build_shortcode_content($atts, $conteo_actual);
    corefix_contador_enqueue_scripts();

    return $shortcode_content;
}

function corefix_contador_parse_attributes($atts) {
    return shortcode_atts(array(
        'fecha_inicial' => '',
        'fecha_final' => '',
        'conteo_total' => 1000,
        'tiempo_entre_incrementos_dia' => 1,
        'tiempo_entre_incrementos_noche' => 5,
        'etiqueta' => 'div'
    ), $atts);
}


function corefix_contador_calcular_conteo_actual($atts) {
    $fecha_inicial = strtotime($atts['fecha_inicial']);
    $fecha_final = strtotime($atts['fecha_final']);
    $fecha_actual = current_time('timestamp');
    $diferencia_fechas = $fecha_final - $fecha_inicial;
    $diferencia_fechas_porcentaje = $diferencia_fechas / $atts['conteo_total'];
    $diferencia_fechas_actual = $fecha_actual - $fecha_inicial;

    // Verificar si la fecha actual es igual a la fecha inicial o final
    if ($fecha_actual == $fecha_inicial) {
        return round($atts['conteo_total'] - ($diferencia_fechas_actual / $diferencia_fechas_porcentaje) - 0.5);
    } elseif ($fecha_actual == $fecha_final) {
        return round($atts['conteo_total'] - ($diferencia_fechas_actual / $diferencia_fechas_porcentaje) - 0.3);
    }

    return round($atts['conteo_total'] - ($diferencia_fechas_actual / $diferencia_fechas_porcentaje));
}

function corefix_contador_build_shortcode_content($atts, $conteo_actual) {
    $shortcode_content = '<' . $atts['etiqueta'] . ' class="corefix-contador" id="corefix-contador-' . uniqid() . '"';
    foreach ($atts as $attribute => $value) {
        $shortcode_content .= ' data-' . $attribute . '="' . esc_attr($value) . '"';
    }
    $shortcode_content .= '><span class="corefix-contador-valor">' . $conteo_actual . '</span></' . $atts['etiqueta'] . '>';
    return $shortcode_content;
}

function corefix_contador_enqueue_scripts() {
    wp_enqueue_style('corefix-contador-estilos', plugins_url('assets/css/contador.css', dirname(__FILE__)), array(), '1.0');
    wp_enqueue_script('corefix-contador-js', plugins_url('assets/js/contador.js', dirname(__FILE__)), array('jquery'), '1.0', true);
}
