<?php
namespace App\Models;

use App\Models\Contribution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loan_detail';

    protected $fillable = [
        'id',
        'regimental_number',
        'category',
        'eno',
        'approved_amount',
        'no_of_installments',
        'no_of_installments_paid',
        'total_recovered_capital',
    ];

    public function contributionloan(){
        return $this->belongsTo(Contribution::class);
    }

}
