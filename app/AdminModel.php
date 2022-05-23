<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class AdminModel extends Authenticatable
{
    //
    use HasRoles;
    protected $guard_name = 'admin';
    public $table = 'admins';

    protected $fillable = ['name', 'folder', 'avatar', 'email', 'password', 'role_id'];

    use Notifiable;

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function role()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role', 'role_id', 'id');
    }
    public function getPermissionsId(){
        return DB::table('model_has_permissions')->where([
            ['model_type', $this->getMorphClass()],
            ['model_id', $this->id]
        ])->pluck('permission_id');
    }


    public function setPermission($data){
        DB::table('model_has_permissions')->where([
            ['model_type', $this->getMorphClass()],
            ['model_id', $this->id]
        ])->delete();
        self::givePermissionTo($data);
    }
}
