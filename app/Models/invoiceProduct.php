<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class invoiceProduct extends Model
{
    use HasFactory;

    protected $table = 'invoices_products';
    
    protected $fillable = ['invoice_id', 'product_id', 'qty', 'sale_price','user_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
