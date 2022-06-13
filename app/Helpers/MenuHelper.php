<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class MenuHelper
{
    /**
     * Builds a menu tree from a collection of menu items.
     * 
     * @param Collection $menuItems
     * 
     * @return array An array of menu items.
     */
    public static function build(array $items) : array 
    {
        if(!isset($parent_id)){
            $parent_id = 0;
        }

        foreach ($items as $item) {

            if ($item['parent_id'] == $parent_id) {
                
                // build children for parent if exists 
                $children = self::build($items, $item['id']);

                // children built, add to parent
                if ($children) {
                    $item['children'] = $children;
                }

                $menus[] = $item;
            }
        }
    }

}