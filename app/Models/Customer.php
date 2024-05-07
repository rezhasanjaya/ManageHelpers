<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    public function billings()
    {
        return $this->hasMany(Billing::class, 'id_customer', 'id');
    }
}