<?php

namespace App\Models\Menu;

use App\Models\BaseModel;

/**
 * Class MenuHasResource
 *
 * @property int $menu_id
 * @property string $resource
 * @property int $resource_id
 *
 * @property Menu $menu
 *
 * @package App\Models
 */
class MenuHasResource extends BaseModel
{
    protected $table = 'menu_has_resource';
    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'menu_id' => 'int',
        'resource_id' => 'int'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
