<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'second_name',
        'email',
        'phone',
        'number_of_ticket',
        'name_of_ticket',
        'ticket_cost',
        'is_valid',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
