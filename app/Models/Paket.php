<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'id_provider', 'id');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class, 'id_paket', 'id');
    }
}
