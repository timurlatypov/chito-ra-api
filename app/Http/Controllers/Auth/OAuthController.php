<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use App\Traits\OAuthTrait;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OAuthController extends Controller
{
    use OAuthTrait;

    private $client;

    /**
     * Create a new controller instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     *
     */
    public function user(Request $request)
    {
        return (new UserResource($request->user()));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function refreshToken(Request $request)
    {
        $oauth_client = DB::table('oauth_clients')
            ->where('id', config('passport.oauth_client_id'))
            ->first();

        $tokens = $this->refreshPassportToken($request->get('token'), $oauth_client->id, $oauth_client->secret);

        return response()->json([
            'access_token'  => $tokens->access_token,
            'refresh_token' => $tokens->refresh_token,
        ], Response::HTTP_OK);

    }
}
