<?php

class CorefixContadorShortcode {
    public function __construct() {
      add_shortcode('corefix_contador', array($this, 'generarContadorShortcode'));
      add_action('wp_enqueue_scripts', array($this, 'cargarRecursos'));
    }
  
    public function cargarRecursos() {
      wp_enqueue_style('corefix-contador', plugins_url('/corefix-contador.css', __FILE__));
      wp_enqueue_script('corefix-contador', plugins_url('/corefix-contador.js', __FILE__), array('jquery'), null, true);
    }
    function calcularProgreso($fechaInicio, $fechaFin, $valorInicio, $valorFin) {    
        $fechaActual = new DateTime();
        $tiempoTotal = $fechaFin->getTimestamp() - $fechaInicio->getTimestamp();
        $tiempoTranscurrido = $fechaActual->getTimestamp() - $fechaInicio->getTimestamp();
        $progresoTiempo = $tiempoTranscurrido / $tiempoTotal;
        $valorActual = $valorInicio + ($valorFin - $valorInicio) * $progresoTiempo;
        return  round($valorActual);
      }
  
    public function generarContadorShortcode($atts) {
        $required_atts = array('startdate', 'enddate', 'endvalue', 'periodday', 'periodnight');
        $missing_atts = array();
        foreach ($required_atts as $att) {
            if (empty($atts[$att])) {
                $missing_atts[] = $att;
            }
        }
        if (!empty($missing_atts)) {
            $missing_atts_str = implode(', ', $missing_atts);
            return "<p>Falta información para mostrar el contador. Los siguientes atributos son obligatorios: $missing_atts_str.</p>";
        }
        $atts['startvalue']=empty($atts['startvalue'])?0:$atts['startvalue'];
        $html = '<div class="corefix-contador"';
        foreach ($atts as $key => $value) {
            // Utilizar la sintaxis de interpolación de cadenas
            $html .= " data-$key=\"" . esc_attr($value) . "\"";
        }
        $html .= '><div class="corefix-contador-mostrar"></div></div>';
        return $html;
    }
  //[corefix_contador startDate="01-03-2023" enddate="10-03-2023" startvalue="100" endvalue="200" periodday="8" periodnight="16"]
  }
  
  new CorefixContadorShortcode();
  