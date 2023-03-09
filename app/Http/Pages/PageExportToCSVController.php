<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Pages\Page;

// Resources
use DDD\Domain\Pages\Resources\PageResource;

class PageExportToCSVController extends Controller
{
    public function export(Organization $organization, Request $request)
    {
        // Get pages
        $pages = $organization->pages()->parents()->orderBy('order')->get();
        $pages = PageResource::collection($pages);
        $pages = $this->flatten(collect($pages)->toArray());


        // Setup CSV
        $fileName = $organization->slug . '-pages.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array(
            'Title',
            'Parents',
            'Url',
            'Category',
            'Wordcount',
        );

        $callback = function() use($pages, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pages as $page) {
                $row['Title'] = $page->formattedTitle;
                $row['Parents'] = $page->parents;
                $row['Url'] = $page->url;
                $row['Category'] = $page->category ? $page->category->title : 'Uncategorized';
                $row['Wordcount'] = $page->wordcount;

                fputcsv($file, array(
                    $row['Title'],
                    $row['Parents'],
                    $row['Url'],
                    $row['Category'],
                    $row['Wordcount'],
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function flatten($input, $level = 0, $parents = '')
    {
        // $level = 0;
        $output = [];

        // For each object in the array
        foreach ($input as $object) {
            // Set level
            $object->level = $level;

            // Setup formatted title
            $object->formattedTitle = $object->level ? str_repeat('-', $object->level) . ' ' . $object->title : $object->title;

            // Set parents
            if ($object->parent_id) {
                $object->parents = $parents;
            }

            // separate its children
            $children = isset($object['children']) ? $object['children'] : [];
            $object['children'] = [];

            // and add it to the output array
            $output[] = $object;

            // Recursively flatten the array of children
            $children = $this->flatten(
                $children,
                $level + 1,
                $parents ? $parents . ' / ' . $object->title : $object->title
            );

            //  and add the result to the output array
            foreach ($children as $child) {
                $output[] = $child;
            }
        }
        return $output;
    }

    // public function flatten($input, $key)
    // {
    //     // $level = 0;
    //     $output = [];
    //
    //     // For each object in the array
    //     foreach ($input as $object) {
    //
    //         // separate its children
    //         // if (isset($object->$key)) {
    //         //     $children = $object->$key;
    //         // } else {
    //         //     $children = [];
    //         // }
    //         // $object->$key = [];
    //
    //         // separate its children
    //         $children = isset($object->$key) ? $object->$key : [];
    //         $object->$key = [];
    //
    //         // and add it to the output array
    //         $output[] = $object;
    //
    //         // Recursively flatten the array of children
    //         $children = $this->flatten($children, $key);
    //
    //         //  and add the result to the output array
    //         foreach ($children as $child) {
    //             $output[] = $child;
    //         }
    //     }
    //     return $output;
    // }
}
