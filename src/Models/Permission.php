<?php

namespace Cherish\Ly\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, 'pg_id');
    }
}