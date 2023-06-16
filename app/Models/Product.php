<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;
    protected $table='products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'user_id'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

}
