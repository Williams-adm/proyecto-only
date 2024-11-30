<?php

namespace App\Http\Controllers\ApiExterna;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RucController extends Controller
{
    public function searchRuc($ruc){
        $token = 'apis-token-11921.tMjZeQXy36vFbD9NlwVMZIYohD4HrXFf';
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]); /* activar para produccion */

        try{
            $parameters = [
                'http_errors' => false,
                'connect_timeout' => 5,
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Referer' => 'https://apis.net.pe/api-consulta-ruc',
                    'User-Agent' => 'laravel/guzzle',
                    'Accept' => 'application/json',
                ],
                'query' => ['numero' => $ruc],
            ];
            $response = $client->request('GET', '/v2/sunat/ruc', $parameters);
            $data = json_decode($response->getBody()->getContents(), true);

            return response()->json($data); // Devuelve los datos en formato JSON al frontend
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al consultar el RUC'], 500);
        }
    }
}
