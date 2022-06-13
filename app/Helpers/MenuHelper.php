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
    public static function build(Collection $items) : array 
    {
        $items = $items->toArray();
        return self::buildRecursive($items);
    }

    /**
     * Recursive function to build the menu tree.
     * 
     * @param array $items The menu items
     * @param int $parentId The parent id
     * 
     * @return array The menu tree
     */ 
    protected static function buildRecursive(array $items, $parent_id = 0) : array
    {
        $menus = [];
    
        foreach ($items as $item) {

            if ($item['parent_id'] == $parent_id) {
                
                // build children for parent if exists 
                $children = self::buildRecursive($items, $item['id']);

                // children built, add to parent
                if ($children) {
                    $item['children'] = $children;
                }

                $menus[] = $item;
            }
        }
    
        return $menus;
    }
}