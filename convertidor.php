<!DOCTYPE HTML>
<html>
<head>
	<title>Convertidor de Temperaturas</title>
<style>
.error {color: #FF0000;}
.resultado {color: #074b83}
</style>
</head>
<body> 

<?php
    require 'temperatura.php';
    $temp = 0; 
    $unidad  = $tempErr = $convertidor = "";
    $nueva_temp = new Temperatura();
    $tempOK = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	if (empty($_POST['temp'])) {
    		$tempErr = "Inserte una temperatura!"; 
    	} else {
    		$temp = $_POST['temp'];
    		$unidad = $_POST['unidad'];
    		$convertir = $_POST['convertir'];

    		if (!is_numeric($temp)) {
    			$tempErr = "La temperatura debe ser un valor numerico";
    		}
    		else {
    			$temp = (int)$temp;
    			$temperatura = new Temperatura((int)$temp, $unidad);
    			$nueva_temp = convertidor($temperatura, $convertir);
    			$tempOK = $nueva_temp->__toString();
    		}
    	}
    }

    function convertidor($temperatura, $convertir) {
    	$nueva_temp = new Temperatura();
        $unidad = $temperatura->unidad;

        if ($unidad == "Celsius" and $convertir == "Fahrenheit") {
        	$nueva_temp = celsius_to_fahrenheit($temperatura);
        } elseif ($unidad == "Celsius" and $convertir == "Kelvin") {
        	$nueva_temp = celsius_to_kelvin($temperatura);
        } elseif ($unidad == "Fahrenheit" and $convertir == "Celsius") {
        	$nueva_temp = fahrenheit_to_celsius($temperatura);
        } elseif ($unidad == "Fahrenheit" and $convertir == "Kelvin") {
        	$nueva_temp = fahrenheit_to_kelvin($temperatura);
        } elseif ($unidad == "Kelvin" and $convertir == "Celsius") {
        	$nueva_temp = kelvin_to_celsius($temperatura);
        } elseif ($unidad == "Kelvin" and $convertir == "Fahrenheit") {
        	$nueva_temp = kelvin_to_fahrenheit($temperatura);
        } else {
        	$nueva_temp = $temperatura;
        }
        return $nueva_temp;
    }
?>

<h1>Convertidor de Temperaturas</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<br>
    <label>
        Temperatura
        <input type="number" name="temp" value="<?php echo $temp;?>">
    </label>

    <label>
        Unidad
        <select name="unidad">
        	<option value="Celsius">Celsius</option>
        	<option value="Fahrenheit">Fahrenheit</option>
        	<option value="Kelvin">Kelvin</option>
        </select>
    </label>
    <br>
    <span class="error"><?php echo $tempErr;?></span>
    <br>
    <label>
        Convertir a:
        <select name="convertir">
        	<option value="Celsius">Celsius</option>
        	<option value="Fahrenheit">Fahrenheit</option>
        	<option value="Kelvin">Kelvin</option>
        </select>
    </label>
    <input type="submit">

    <span class="resultado">
    <?php
    echo "<h3>Resultado:</h3>";
    echo $tempOK;
    ?>
    </span>

</form>

</body>
</html>