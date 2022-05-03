<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'theme_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Verifica se o operador está ativo.
    *
    * @var active
    */
    public function hasAccess(){
        return ($this->active == 'Y') ? true : false;
    }

    /**
     * Perifs do operador
     *
     * @var Role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Verifica se um operador tem determinado(s) perfil(is)
     *
     * @var Bool
     */
    public function hasRoles($roles)
    {
        $userRoles = $this->roles;
        return $roles->intersect($userRoles)->count();
    }
    
    /**
     * Verifica se um operador tem determinado perfil
     *
     * @var Bool
     */
    public function hasRole($role)
    {
        if(is_string($role)){
          $role = Role::where('name','=',$role)->firstOrFail();
        }
        return (boolean) $this->roles()->find($role->id);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }    
}
