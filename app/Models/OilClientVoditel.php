<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilClientVoditel extends Model
{
    use HasFactory;

    protected $table = 'oil_client_voditels';
    protected $guarded = false;
}
