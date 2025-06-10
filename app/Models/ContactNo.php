<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactNo extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = [
        'id',
        'land_no',
        'army_extension_no',
        'created_at',
        'updated_at',
    ];
}
