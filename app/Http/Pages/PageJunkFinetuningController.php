<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\Domain\Pages\Page;
use DDD\Domain\Organizations\Organization;
use DDD\App\Controllers\Controller;

class PageJunkFinetuningController extends Controller
{
    public function export(Organization $organization, Request $request)
    {
        $pagesSets = [
            Page::where('junk_status', 'junk')->orderByRaw('RAND()')->take(100)->get(),
            Page::where('junk_status', 'keep')->orderByRaw('RAND()')->take(500)->get(),
        ];
        
        $pages = collect();
        foreach ($pagesSets as $set) {
            $pages = $pages->merge($set);
        };

        $fileName = 'finetuning-for-page-junk-status-' . now()->format('Y-m-d') . '.jsonl';
        
        $fileHeaders = array(
            "Content-type"        => "application/jsonl",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($pages) {
            $file = fopen('php://output', 'w');
            
            foreach ($pages as $page) {
                $messages = [ 'messages' => [
                    ['role' => 'system', 'content' => 'You are a text classification assistant.'],
                    ['role' => 'user', 'content' => "Classify the following text as keep, junk or not sure: {$page->title} ({$page->url})"],
                    ['role' => 'assistant', 'content' => "{$page->junk_status}"],
                ]];

                fwrite($file, json_encode($messages));
                fwrite($file, PHP_EOL);
            };

            fclose($file);
        };

        
        return response()->stream($callback, 200, $fileHeaders);
    }
}
