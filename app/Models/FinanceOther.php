<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class FinanceOther extends Model
{
    use HasFactory;
    protected $table = 'FinanceOther';
    protected $fillable = ['id','cus_id','court_fee','send_defendant','mandatory_fee','copy_documents1','check_ownership','copy_documents2','point_property'];

 
    public function FinanceOtherToFin()
    {
        return $this->hasOne(Finance::class,'id','cus_id');
    }
}
