<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilClient extends Model
{
    use HasFactory;

    protected $table = 'oil_clients';
    protected $guarded = false;

    public function drivers()
    {
        return $this->hasMany(OilClientVoditel::class, 'oil_client_id', 'id')->orderBy('id', 'DESC');
    }
}
