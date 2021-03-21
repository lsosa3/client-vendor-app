<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsRequests extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'vendor_id', 'description', 'price', 'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'created_at' => 'datetime',
    ];*/
}
