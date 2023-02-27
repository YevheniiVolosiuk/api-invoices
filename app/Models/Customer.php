<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    protected $primaryKey = 'id';

    public $fillable = [
        'first_name',
        'last_name',
        'type',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
