<?php

namespace lib;

class Http{

    function get($url, $data = null){
        $curl = curl_init();
        
        $url = sprintf("%s?%s", $url, http_build_query($data));

        $this->setCurl($curl);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    function post($url, $data = null){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, true);

        if($data){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        $this->setCurl($curl);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    private function setCurl(&$curl){
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    }

}