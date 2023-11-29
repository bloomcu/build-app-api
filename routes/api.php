<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Crawls\CrawlController;
use DDD\Http\Crawls\CrawlResultsController;
use DDD\Http\Crawls\CrawlResultsImportController;
use DDD\Http\Designs\DesignController;
use DDD\Http\Designs\DesignMediaController;
use DDD\Http\Designs\DesignDuplicationController;
use DDD\Http\Pages\PageController;
use DDD\Http\OpenAI\Finetuning\ExportFinetuningForJunkPagesController;
use DDD\Http\Pages\PageExportToCSVController;
use DDD\Http\Pages\PageNestingController;
use DDD\Http\Redirects\RedirectController;

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
    Route::get('/pages/junk', [ExportFinetuningForJunkPagesController::class, 'export']);
});

// Public - Pages export to CSV
Route::prefix('{organization:slug}/pages/export')->group(function() {
    Route::get('/csv', [PageExportToCSVController::class, 'export']);
});

Route::middleware('auth:sanctum')->group(function() {
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
