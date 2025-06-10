<?php
namespace App\Models;

use App\Models\Loan;
use App\Models\Nominee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contribution extends Model
{
    use HasFactory;

    protected $table = 'contibution_summary_detail';

    protected $fillable = [
        'regimental_number',
        'category',
        'eno',
        'closing_balance',
        'contribution_amount',
        'membership_id',
        'opening_balance',
        'year',
        'yearly_interest',
        'icp_id',
    ];

    public function loan(){
        return $this->hasMany(Loan::class);
    }

    public function nominee(){
        return $this->hasMany(Nominee::class);
    }
}
