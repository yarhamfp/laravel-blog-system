<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'subname', 'slug', 'icon',];

    public function nameweb()
    {
        $name = $this->first()->name;
        $subname = $this->first()->subname;
        return $name . $subname;
    }
}
