<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPharmacy extends Model
{
    use HasFactory;
    protected $table = 'pharmacy_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'pharmacy_id', 'product_price', 'product_quantity'];


}
