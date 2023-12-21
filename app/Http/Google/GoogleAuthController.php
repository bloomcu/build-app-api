<?php

namespace DDD\Http\Google;

use Illuminate\Http\Request;
use DDD\App\Facades\GoogleAuth;
use DDD\App\Controllers\Controller;

class GoogleAuthController extends Controller
{
    /**
     * Get the Google auth URL.
     *
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request)
    {
        $url = GoogleAuth::addScope($request->scope)->getAuthUrl();
        
        return response()->json([
            'url' => $url
        ], 200);
    }

    /**
     * Get the Google access token. 
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {   
        $googleCredentials = GoogleAuth::storeCredentials($request->code);

        return response()->json([
            'service' => $googleCredentialsr
        ], 200);
    }
}
