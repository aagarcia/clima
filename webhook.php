<?php
    include_once "libreria/somosioticos_dialogflow.php";
    include_once "libreria/posicionamiento_ciudad.php";
    include_once "libreria/clima_ciudad.php";



    credenciales('climabot', 'Climab0t#2019');

    /** para grabar el json que viene de la interaccion */
    debug();
    
    if(intent_recibido("clima")) {
        
        $ciudad = obtener_variables()['geo-city'];

        if($ciudad == "")
        {
            enviar_texto("La ciudad que envio no es valida");
        }

        $resultado = json_decode(ciudad($ciudad),true);

        if(count($resultado["Results"]) > 0) {
            //file_put_contents('ciudad.js', "Lat - " . $resultado["Results"][0]["lat"] . " : Lon - " . $resultado["Results"][0]["lon"]);

            $respuesta = clima($ciudad, $resultado["Results"][0]["lat"], $resultado["Results"][0]["lon"]);

            $respuesta = str_replace("test(", "", $respuesta);
            $respuesta = str_replace(")", "", $respuesta);
            $respuesta = json_decode($respuesta,true);

            //file_put_contents('clima.js', gettype($respuesta) . "-" . $respuesta["main"]["temp"]);

            enviar_texto("La temperatura de la ciudad " . $ciudad . " es de ". $respuesta["main"]["temp"] . "°C");
            //enviar_texto("Hola " . $ciudad);
        }
        else
        {
            enviar_texto("Ciudad no encontrada - " . $ciudad);
        }
    }
