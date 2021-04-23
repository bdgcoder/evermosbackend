<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    protected $fillable = [
        'invoiceID',
        'itemID',
        'customerID',
        'qty',
        'price',
        'totalprice',
        'delivery_at',
    ];
}
