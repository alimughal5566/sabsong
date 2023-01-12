<?php

namespace App\Http\Controllers;

use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
//    private $clientURL="https://website.sportsbetsasia.com";
//    private $adminURL="https://website.sportsbetsasia.com";
//    private $client_id="981abb52-d0b2-4831-ac09-73f9b69e5288";
//    private $client_secret="DLexby28BTMMJqQYfCrIkefzqPdfdUTDvP1hzCnB";
    private $clientURL="http://127.0.0.1:8080";
    private $adminURL="http://127.0.0.1:8000";
    private $client_id="9834d3e4-8a56-46ac-8beb-8b3c020d0296";
    private $client_secret="ZHqEvQ0cAKEbBqoS8Z88Llz2dpBnnuU5D3JtxIkh";
    public function authCallback (Request $request){

    $request->session()->put("state",$state=Str::random(40));

    $query=http_build_query([
        "client_id"=>$this->client_id,
        "redirect_uri"=>$this->clientURL."/callback",
        "response_type"=>"code",
        "scope"=>"",
        "state"=>$state,
    ]);
    return redirect( $this->adminURL."/oauth/authorize?".$query);

    }
    public function tokenGenerate  (Request $request)
    {
        $state = $request->session()->pull('state');
        throw_unless(strlen($state) > 0 && $state = $request->state, InvalidArgumentException::class);
        $response = Http::asForm()->post($this->adminURL."/oauth/token",
            [
                "grant_type" => "authorization_code",
                "client_id" => $this->client_id,
                "client_secret" => $this->client_secret,
                "redirect_uri" => $this->clientURL."/callback",
                "code" => $request->code
            ]);

        $request->session()->put($response->json());
        return redirect('/authuser');
    }
    public function getUser(Request $request){
        $access_token=$request->session()->get('access_token');
        $response = Http::withHeaders([
            'Accept'=>"application/json",
            'Authorization'=>"Bearer " . $access_token
        ])->get($this->adminURL.'/api/user');
        return $response->json();
//    $url='http://server.ggbettings.com/user'.'/'.$access_token;
//    return Redirect::to($url);
    }
public function sendUser(Request $request){
        $access_token=$request->get('access_token');

		$response = Http::withHeaders([
            'Accept'=>"application/json",
            'Authorization'=>"Bearer " . $access_token
        ])->get($this->adminURL.'/api/user');
           return $response->json();
    }
}
