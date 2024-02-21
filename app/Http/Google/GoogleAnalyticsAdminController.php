<?php

namespace DDD\Http\Google;

use DDD\App\Facades\GoogleAnalyticsAdmin;
use DDD\App\Controllers\Controller;

class GoogleAnalyticsAdminController extends Controller
{
    /**
     * List users' Google Analytics accounts. 
     *
     * @return \Illuminate\Http\Response
     */
    public function listAccounts()
    {
        $accounts = GoogleAnalyticsAdmin::listUserAccounts(auth()->user());
        
        return response()->json([
            'accounts' => $accounts
        ], 200);
    }
}
