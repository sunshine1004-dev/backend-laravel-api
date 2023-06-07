<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
class Helper
{
    /**
     * @param $url_params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function makeGuardianAPiCall($url_params)
    {
        try {
            $client = new Client();
            $apiRequest = $client->request('GET', config('app.the_guardian_url') .'?api-key=' . config('app.the_guardian_key') .$url_params);
            return json_decode($apiRequest->getBody()->getContents(), true);
        } catch (RequestException $e) {
            //For handling exception
            return json_decode($e->getRequest());
            if ($e->hasResponse()) {
                return json_decode($e->getResponse());
            }
        }
    }
}