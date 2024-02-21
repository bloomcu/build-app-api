<?php

namespace DDD\Http\Google;

use DDD\App\Controllers\Controller;

class GoogleAnalyticsDataController extends Controller
{
    /**
     * Run a Google Analytics Data report.
     *
     * @return \Illuminate\Http\Response
     */
    public function runReport()
    {
        return response()->json([
            'data' => ''
        ], 200);
    }
}
