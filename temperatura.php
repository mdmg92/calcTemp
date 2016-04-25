<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

<?php
    // clase temperatura: temp y unidad
    class Temperatura {
        var $temp;
        var $unidad;

    // Funciones set
        public function __construct($temp=0, $unidad="Desconocida") {
            $this->set_unidad($unidad);
            $this->set_temp($temp);
        }

        function set_temp($temp) {
            if (!gettype($temp) == "integer" or gettype($temp) == "double") {
                $this->temp = "Desconodida";
            } else {
                $this->temp = $temp;
            }
        }

        function set_unidad($unidad) {
            $unidades = array("Celsius", "Fahrenheit", "Kelvin");
            for ($i=0; $i < count($unidades); $i++) { 
                if ($unidad == $unidades[$i]) {
                    $this->unidad = $unidad;
                }
            }
            if (empty($this->unidad)) {
                $this->unidad = "Desconodida";
            }
        }

        // funciones get
        public function get_temp() {
            return $this->temp;
        }

        public function get_unidad() {
            return $this->unidad;
        }

        // validar temperatura
        function valid_temp($temp, $unidad) {
            if ($unidad == 'Kelvin') {
                if ($temp < 0) {
                    trigger_error("Una temperatura Kelvin no puede ser 
                                  menor a 0");
                }
            } elseif ($unidad == 'Celsius') {
                if ($temp < -273.15) {
                    trigger_error("Una temperatura Celsius no puede ser
                                  menor a -273.15 (cero absoluto)");
                }
            } elseif ($unidad == 'Fahrenheit') {
                if ($temp < -459.67) {
                    trigger_error("Una temperatura Fahrenheit no puede 
                                  ser menor a -459.67 (0 absoluto)");
                }
            } else {
                return true;
            }
        }

        // to_String
        function __toString() {
            if ($this->unidad != 'Kelvin') {
                return $this->temp . "º" . substr($this->unidad, 0, 1);
            } else {
                return $this->temp . " " . substr($this->unidad, 0, 1);
            }
            
        }
    }

    // Convertir de Celsius a Fahrenheit
    function celsius_to_fahrenheit($celsius) {
        $temp = 9/5 * ($celsius->temp + 32);
        $fahrenheit = new Temperatura((int)$temp, "Fahrenheit");
        return $fahrenheit;
    }

    // Convertir de Celsius a Kelvin
    function fahrenheit_to_celsius($fahrenheit) {
        $temp = 5/9 * ($fahrenheit->temp - 32);
        $celsius =  new Temperatura((int)$temp, "Celsius");
        return $celsius;
    }

    // Convertir de Fahrenheit a Celsius
    function celsius_to_kelvin($celsius) {
        $temp = $celsius->temp + 273.15;
        $kelvin = new Temperatura((int)$temp, "Kelvin");
        return $kelvin;
    }

    // Convertir de Fahrenheit a Kelvin
    function kelvin_to_celsius($kelvin) {
        $temp = $kelvin->temp - 273.15;
        $celsius = new Temperatura((int)$temp, "Celsius");
        return $celsius;
    }

    // Convertir de Kelvin a Celsius
    function fahrenheit_to_kelvin($fahrenheit) {
        $temp = (5/9 * ($fahrenheit->temp - 32)) + 273.15;
        $kelvin = new Temperatura((int)$temp, "Kelvin");
        return $kelvin;
    }

    // Convertir de Kelvin a Fahrenheit
    function kelvin_to_fahrenheit($kelvin) {
        $temp = 9/5 * ($kelvin->temp - 273.15) + 32;
        $fahrenheit = new Temperatura((int)$temp, "Fahrenheit");
        return $fahrenheit;
    }
?>