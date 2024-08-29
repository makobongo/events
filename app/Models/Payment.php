<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'TransactionType',
        'TransID',
        'TransTime',
        'BusinessShortCode',
        'BillRefNumber',
        'InvoiceNumber',
        'ThirdPartyTransID',
        'MSISDN',
        'FirstName',
        'MiddleName',
        'LastName',
        'TransAmount',
        'OrgAccountBalance',
        'ticket_number',
        'ticket_is_valid',
    ];
}
