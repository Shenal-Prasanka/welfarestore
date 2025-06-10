<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $table = 'nominee_detail';

    protected $fillable = [
        'id',
        'regimental_number',
        'category',
        'eno',
        'name',
        'relationship_name',

    ];

    public function contributionnominee(){
        return $this->belongsTo(Contribution::class);
    }

}
