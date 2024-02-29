<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'qty',
        'color',
        'image_path',
        'company_id',
    ];

    // Relationship with Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

 // Inside the Product model

public function images()
{
    return $this->hasMany(ProductImage::class);
}

}
