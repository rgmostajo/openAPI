<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class dailymotionController extends Controller
{
    public function getApiToken()
    { 
                
        $client = new Client();
        $authCode = base64_encode(env('CLIENT_ID').':'.env('CLIENT_SECRET'));
        
        $headers = [
            'Authorization' => 'Basic '.$authCode,
            'Content-type' => 'application/x-www-form-urlencoded'
        ];

        $params = [
            'grant_type' => 'client_credentials',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'redirect_uri' => 'http://127.0.0.1:8000/dailymotion/playlists'
        ];

        $response = $client->request('POST', 'https://api.dailymotion.com/oauth/token', [
            'headers' => $headers,
            'form_params' => $params
        ]);
        
        return $response;
    }

    public function retreiveApiToken()
    { 
        $client = new Client();

        $authCode = base64_encode(env('CLIENT_ID').':'.env('CLIENT_SECRET'));
        
        $headers = [
            'Authorization' => 'Basic '.$authCode
        ];

        $params = [
            'client_id' => env('CLIENT_ID'),
            'redirect_uri' => 'http://127.0.0.1:8000/dailymotion/playlists'
        ];

        $response = $client->request('GET', 'https://www.dailymotion.com/oauth/authorize', [
            'headers' => $headers,
            'query' => $params
        ]);
        
        return $response;
    }

    public function fetchVideos(Request $request)
    {
        $client = new Client();
        $input = $request->all();

        $headers = [
            'Authorization' => 'Bearer '.$input['token'],
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $params = [
            'fields' => $input['fields']
        ];

        //List of video fields: https://developer.dailymotion.com/api/#video-fields
        $response = $client->request ('GET', 'https://api.dailymotion.com/videos', [
            'headers' => $headers,
            'query' => $params
        ]);

        return json_decode($response->getBody(), true);
    } 

    public function fetchVideo(Request $request, $id)
    {
        $client = new Client();
        $input = $request->all();

        $headers = [
            'Authorization' => 'Bearer '.$input['token'],
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $params = [
            'fields' => $input['fields']
        ];

        //List of video fields: https://developer.dailymotion.com/api/#video-fields
        $response = $client->request ('GET', 'https://api.dailymotion.com/video/'.$input['id'], [
            'headers' => $headers,
            'query' => $params
        ]);

        echo $id;

        return json_decode($response->getBody(), true);
    }

    public function fetchChannel(Request $request, $id)
    {
        $client = new Client();
        $input = $request->all();

        $headers = [
            'Authorization' => 'Bearer '.$input['token'],
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $params = [
            'fields' => $input['fields']
        ];

        //List of channel fields: https://developer.dailymotion.com/api/#channel-fields
        $response = $client->request ('GET', 'https://api.dailymotion.com/channel/'.$input['id'], [
            'headers' => $headers,
            'query' => $params
        ]);

        echo $id;

        return json_decode($response->getBody(), true);
    }

}
