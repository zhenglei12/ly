<?php

namespace Cherish\Ly\Models;


use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $guarded = ['id'];

    public function permission()
    {
        return $this->hasMany('Cherish\Ly\Models\Permission', 'pg_id');
    }
}