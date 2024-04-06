<?php

namespace App\Services\Render;

use App\Models\InfoBlock\InfoBlock;
use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;

class RenderServices
{
    /**
     * @param string|null $table
     * @return array[]
     */
    public function get(string $table = null): array
    {
        $array = [
            Post::table() => [],
            PostCategory::table() => [],
            Page::table() => [],
            InfoBlock::table() => [],
        ];
        return $table ? $array[$table] : $array;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function find(string $name): ?string
    {
        foreach ($this->get() as $key => $items) {
            if (array_key_exists($name, $items)) {
                return $items[$name];
            }
        }

        return null;
    }
}
