<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use DDD\Http\Sites\SiteController;
use DDD\Http\Redirects\RedirectController;
use DDD\Http\Pages\PageNestingController;
use DDD\Http\Pages\PageJunkPredictController;
use DDD\Http\Pages\PageJunkFinetuningController;
use DDD\Http\Pages\PageExportToCSVController;
use DDD\Http\Pages\PageController;
use DDD\Http\Google\GoogleAuthController;
use DDD\Http\Google\GoogleAnalyticsAdminController;
use DDD\Http\Designs\DesignMediaController;
use DDD\Http\Designs\DesignDuplicationController;
use DDD\Http\Designs\DesignController;
use DDD\Http\Crawls\CrawlResultsImportController;
use DDD\Http\Crawls\CrawlResultsController;
use DDD\Http\Crawls\CrawlController;

Route::middleware('auth:sanctum')->group(function() {
    // Google Auth
    // Route::prefix('google/auth')->group(function() {
    Route::prefix('google')->group(function() {
        Route::post('connect', [GoogleAuthController::class, 'connect'])->name('google.auth.connect');
        Route::post('callback', [GoogleAuthController::class, 'callback'])->name('google.auth.callback');
    });

    // Google Analytics
    Route::prefix('google/analytics')->group(function() {
        Route::get('/accounts', [GoogleAnalyticsAdminController::class, 'listAccounts'])->name('google.analytics.accounts');
    });

    // Ai
    Route::get('{organization:slug}/ai/predict-page-junk-status/{page}', [PageJunkPredictController::class, 'predict']);

    // Sites
    Route::prefix('{organization:slug}/sites')->group(function() {
        Route::get('/', [SiteController::class, 'index']);
        Route::post('/', [SiteController::class, 'store']);
        Route::get('/{site}', [SiteController::class, 'show']);
        Route::put('/{site}', [SiteController::class, 'update']);
        Route::delete('/{site}', [SiteController::class, 'destroy']);
    });

    // Crawls
    Route::prefix('{organization:slug}/crawls')->group(function() {
        Route::get('/', [CrawlController::class, 'index']);
        Route::post('/', [CrawlController::class, 'store']);
        Route::get('/{crawl}', [CrawlController::class, 'show']);
        Route::delete('/{crawl}', [CrawlController::class, 'destroy']);

        // Crawl results
        Route::prefix('/{crawl}')->group(function() {
            Route::get('/results', [CrawlResultsController::class, 'show']);
        });

        // Crawl results import
        Route::prefix('/{crawl}')->group(function() {
            Route::get('/import', [CrawlResultsImportController::class, 'import']);
        });
    });

    // Pages
    Route::prefix('{organization:slug}/pages')->group(function() {
        Route::get('/', [PageController::class, 'index']);
        Route::post('/', [PageController::class, 'store']);
        Route::get('/{page}', [PageController::class, 'show']);
        Route::put('/', [PageController::class, 'update']);
        Route::post('/destroy', [PageController::class, 'destroy']);
        Route::post('/restore', [PageController::class, 'restore']);

        // Parent
        Route::put('/{page}/nesting', [PageNestingController::class, 'update']);

        // Tagging
        // route::post('/pages/{page}/tag', [PageTagController::class, 'tag']);
        // route::post('/pages/{page}/untag', [PageTagController::class, 'untag']);
        // route::post('/pages/{page}/retag', [PageTagController::class, 'retag']);
    });

    // Redirects
    Route::prefix('{organization:slug}/redirects')->group(function() {
        Route::get('/', [RedirectController::class, 'index']);
        Route::post('/', [RedirectController::class, 'store']);
        Route::get('/{redirect}', [RedirectController::class, 'show']);
        Route::put('/{redirect}', [RedirectController::class, 'update']);
        Route::delete('/{redirect}', [RedirectController::class, 'destroy']);
    });
});

// Public - Designs
Route::prefix('{organization:slug}')->group(function() {
    Route::get('/designs', [DesignController::class, 'index']);
    Route::post('/designs', [DesignController::class, 'store']);
    Route::get('/designs/{design:uuid}', [DesignController::class, 'show']);
    Route::put('designs/{design:uuid}', [DesignController::class, 'update']);
    Route::delete('/designs/{design:uuid}', [DesignController::class, 'destroy']);
    Route::delete('/designs/{design:uuid}', [DesignController::class, 'destroy']);

    // Public - Duplicate design
    Route::prefix('/designs/{design:uuid}')->group(function() {
        Route::post('/duplicate', [DesignDuplicationController::class, 'duplicate']);
    });

    // Public - Design media
    Route::prefix('/designs/{design:uuid}')->group(function() {
        Route::post('/media', [DesignMediaController::class, 'store']);
    });
});

// Public - Pages export finetuning for junk
Route::prefix('{organization:slug}/openai/finetuning/')->group(function() {
    Route::get('/pages/junk', [PageJunkFinetuningController::class, 'export']);
});

// Public - Pages export to CSV
Route::prefix('{organization:slug}/pages/export')->group(function() {
    Route::get('/csv', [PageExportToCSVController::class, 'export']);
});