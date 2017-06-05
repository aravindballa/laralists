<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'description', 'completed', 'starred'
    ];

    public function todo_list()
    {
        $this->hasOne('App\TodoList');
    }

}
