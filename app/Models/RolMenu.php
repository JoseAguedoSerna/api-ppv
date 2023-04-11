<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolMenu extends Model
{
    use HasFactory,HasUuids, SoftDeletes;

    protected $table = 'RolesMenus';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $fillable = ['uuidRol','uuidMenu'];

    public function rol()
    {
        return $this->belongsTo('App\Models\Roles', 'uuidRol', 'uuid');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menus', 'uuidMenu', 'uuid');
    }

}
