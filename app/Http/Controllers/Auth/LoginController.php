<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\PrivateUserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp;
use GuzzleHttp\Exception\BadResponseException;

class LoginController extends Controller
{
    public function action(Request $request)
    {
	    $http = new GuzzleHttp\Client();

		try {
		    $response = $http->post(config('app.url').'/oauth/token', [
			    'form_params' => [
				    'grant_type' => 'password',
				    'client_id' => '2',
				    'client_secret' => 'ZzA8X2i7bDZAzDY82yeJhYcJ14W0RaDXX4xfpRrY',
				    'username' => $request->email,
				    'password' => $request->password,
				    'scope' => '',
			    ],
		    ]);

		    return response()->json([
		    	'meta' => json_decode((string) $response->getBody(), true)
		    ]);

		} catch (BadResponseException $e) {
			//handle sign in errors here
			return $e;
		}
    }

    public function user(Request $request)
    {
	    return (new PrivateUserResource($request->user()));
    }

}
