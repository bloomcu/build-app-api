<?php

namespace DDD\Domain\Pages\Actions;

use OpenAI\Laravel\Facades\OpenAI;
use Lorisleiva\Actions\Concerns\AsAction;
use DDD\Domain\Pages\Page;

class PredictPageJunk
{
    use AsAction;
    
    /**
     * @param  Page  $page
     * @return string
     */
    function handle(Page $page): string
    {
        $response = OpenAI::chat()->create([
            'model' => 'ft:gpt-3.5-turbo-1106:heyharmon-org::8M2Pgc6A',
            'messages' => [
                [
                    'role' => 'user', 
                    'content' => 'Classify this as "keep", "junk" or "not-sure": ' . $page->title . ' (' . $page->url . ')'
                ],
            ],
        ]);

        $prediction = $response->choices[0]->message->content;

        $page->update([
            'junk_status' => $prediction
        ]);
        
        return $prediction;
    }
}