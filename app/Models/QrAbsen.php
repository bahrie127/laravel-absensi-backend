<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrAbsen extends Model
{
    use HasFactory;

    // table qr_absen
    protected $table = 'qr_absen';

    protected $fillable = [
        'date',
        'qr_checkin',
        'qr_checkout',
    ];
}
