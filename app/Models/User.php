<?php

namespace App\Models;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['mdp'];

    protected $fillable = ['nom','prenom','login', 'mdp', 'type'];

    protected $attributes = [
        'type' => 'user'
    ];


     public function getAuthPassword(){
        return $this->mdp;
    }

    public function isAdmin(){
         return $this->type == 'admin';
    }

    public function isCook(){
        return $this->type == 'cook';
    }

    function commandes(){
        return $this->hasMany(Commande::class,);
    }
}
