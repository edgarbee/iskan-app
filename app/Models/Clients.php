<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $table = 'clients';

    public function dop_zagruzka() {
        return $this->hasMany(Zagruzka::class, 'client_id', 'id');
    }

    public function dop_vigruzka() {
        return $this->hasMany(Vigruzka::class, 'client_id', 'id');
    }
}
