<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{

    public $table = 'permission_role';

    protected $fillable = [
        'role_id','permission_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
    
}
