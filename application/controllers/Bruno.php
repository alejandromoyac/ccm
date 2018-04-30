<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bruno extends CI_Controller
{
    public function index()
    {
        echo "ola k ase :v :V :V ";
    }
    public function autocorrect()
    {
        // NOTE: Be sure to uncomment the following line in your php.ini file.
        // ;extension=php_openssl.dll

// These properties are used for optional headers (see below).
        // define("CLIENT_ID", "<Client ID from Previous Response Goes Here>");
        // define("CLIENT_IP", "999.999.999.999");
        // define("CLIENT_LOCATION", "+90.0000000000000;long: 00.0000000000000;re:100.000000000000");

        $host = 'https://api.cognitive.microsoft.com';
        $path = '/bing/v7.0/spellcheck?';

        $input = "materiias";

        $data = array(
            // 'cc'              => 'pt-BR',
            // 'Accept-Language' => 'BP',
            'mkt'    => 'pt-BR',
            'method' => 'proof',
            'text'   => urlencode($input),
        );

// NOTE: Replace this example key with a valid subscription key.
        $key = '36c2dc79715f44c986d9173d66c03f43';

// The following headers are optional, but it is recommended
        // that they are treated as required. These headers will assist the service
        // with returning more accurate results.
        //'X-Search-Location' => CLIENT_LOCATION
        //'X-MSEdge-ClientID' => CLIENT_ID
        //'X-MSEdge-ClientIP' => CLIENT_IP

        $headers = "Content-type: application/x-www-form-urlencoded\r\n" .
            "Ocp-Apim-Subscription-Key: $key\r\n";

// NOTE: Use the key 'http' even if you are making an HTTPS request. See:
        // http://php.net/manual/en/function.stream-context-create.php
        $options = array(
            'http' => array(
                'header'  => $headers,
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        $result  = file_get_contents($host . $path, false, $context);

        if ($result === false) {
            /* Handle error */
        }
        $result  = json_decode($result);
        $result2 = json_decode(json_encode($result), true);
        // echo "<pre>";
        // print_r($result2);
        // echo "</pre>";

        $correct = "";

        // print_r($result2['flaggedTokens'][0]);

        foreach ($result2['flaggedTokens'] as $row) {
            // echo "<pre>";
            // print_r($row['suggestions'][0]['suggestion']);
            // echo "</pre>";
            $correct = $correct . " " . $row['suggestions'][0]['suggestion'];
        }

        // foreach ($result2['flaggedTokens'] as $row) {
        //     $correct .= $row[0];
        // }

        echo "<br>";
        echo "<h2>Su texto fué: </h2>" . $input;
        echo "<br>";
        echo "<h2>La corrección es: </h2>" . $correct;

        echo "<pre>";
        print_r($result2);
        echo "</pre>";
        //procesar cada palabra por separado ;)

    }
}
