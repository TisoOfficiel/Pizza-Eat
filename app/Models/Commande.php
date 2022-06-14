<?php

namespace App\Models;

use App\Models\Pizza;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Commande extends Model{
    
    use HasFactory;
    
  
    function pizzas(){
        return $this->belongsToMany(Pizza::class, 'commande_pizza', 'commande_id', 'pizza_id')
        ->withPivot('qte')->withTrashed();
    }

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
        
}
