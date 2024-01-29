<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DDD\Domain\Pages\PageType;

class PageTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pageTypes = [
            [
                'title' => 'Product',
                'slug' => 'product',
            ],
            [
                'title' => 'Service',
                'slug' => 'service',
            ],
            [
                'title' => 'Info',
                'slug' => 'info',
            ],
        ];

        foreach ($pageTypes as $type) {
            PageType::create($type);
        }
    }
}
