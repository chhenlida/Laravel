<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    

    protected $dates = ['deleted_at'];

    protected $table = 'orders';
    protected $fillable = ['customer_id', 'order_date', 'total_price'];

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }

    protected function orderDate(): Attribute
    {
        return Attribute::make(
            // Mutator: Convert input format (DD/MM/YYYY HH:MM:SS) to MySQL format (Y-m-d H:i:s)
            set: fn ($value) => Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d H:i:s'),

            // Accessor: Convert MySQL format (Y-m-d H:i:s) back to user format (DD/MM/YYYY HH:MM:SS)
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y H:i:s')
        );
    }
           
    

    
}
