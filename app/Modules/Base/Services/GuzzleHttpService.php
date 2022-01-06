<?php

namespace App\Modules\Base\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class GuzzleHttpService {
    public function consultarEndpoint ($tipo, $endpoint, $params = []) {
        $client = new Client();
        $response = $client->request($tipo, $endpoint, $params);
        return ['statusCode' => $response->getStatusCode(), 'dados' => json_decode($response->getBody())];
    }
}