<?php

namespace App\Models;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pizza extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    function commandes(){
        return $this->belongsToMany(Commande::class, 'commande_pizza', 'pizza_id', 'commande_id')
        ->withPivot('qte');
    }
}
