<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable =[
        'quantidade',
        'valor_unitario',
        'produtos_id',
        'pedidos_id'
    ];
}
