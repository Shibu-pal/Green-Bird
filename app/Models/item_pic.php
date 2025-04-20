<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Item;

class item_pic extends Model
{
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
