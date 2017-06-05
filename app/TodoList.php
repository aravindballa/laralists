<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function user()
    {
        $this->hasOne('App\User');
    }

    public function items()
    {
        $this->hasMany('App\Item');
    }
}
