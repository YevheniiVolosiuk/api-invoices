<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoices';

    protected $primaryKey = 'id';

    protected $casts = [
        'billed_date' => 'datetime',
        'paid_date' => 'datetime',
    ];

    protected $fillable = [
        'customer_id',
        'amount',
        'status',
        'billed_date',
        'paid_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
