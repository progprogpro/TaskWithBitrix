<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autoria extends Model
{
    public $table = 'autoria_info';

    protected $fillable = [
        'lead_id',
        'car_category',
        'car_mark',
        'car_model',
    ];

    public function lead()
    {
        return $this->belongsTo('App\Lead');
    }
}
