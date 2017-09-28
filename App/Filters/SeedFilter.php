<?php
namespace App\Filters;

use Services\Filter;

class SeedFilter extends Filter
{
    public static function filterCSV($fileInput)
    {
        $file = file($fileInput, FILE_SKIP_EMPTY_LINES);
        $lines = count(file($fileInput, FILE_SKIP_EMPTY_LINES));
        $items = [];
        for($i=1; $i < $lines; $i++){
            $item = explode(',',$file[$i]);
            if(isset($item[1])){
                $item = trim($item[1],'"');
                $items[] = $item;
            }
        }
        return array_unique($items);
    }
}