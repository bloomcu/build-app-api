<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DDD\Domain\Pages\PageJunkStatus;

class PageJunkStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pageJunkStatuses = [
            [
                'title' => 'Keep',
                'slug' => 'keep',
            ],
            [
                'title' => 'Junk',
                'slug' => 'junk',
            ]
        ];

        foreach ($pageJunkStatuses as $status) {
            PageJunkStatus::create($status);
        }
    }
}
