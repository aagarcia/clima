<?php

    

    function clima($ciudad, $lat, $lon) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://community-open-weather-map.p.rapidapi.com/weather?lat=" . $lat . "&lon=" . $lon ."&callback=test&lang=sp&units=metric&q=" . $ciudad,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
                "x-rapidapi-key: 0c4f20366dmshadceeefd840ba7ep1f523ajsnc77a5bd8a95b"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }

    }