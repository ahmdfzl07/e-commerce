<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FullCustom extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function citie()
    {
        return $this->belongsTo(Citie::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
