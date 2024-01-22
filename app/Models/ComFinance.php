<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class ComFinance extends Model
{
    use HasFactory;
    protected $table = 'ComFinance';
    protected $fillable = ['id','created_at','updated_at','pay_date','type','pay_amount','due_date','Payee'];
    public function ComFinToCom()
    {
        return $this->hasOne(Compromise::class,'cus_id','cus_id')->latest();;
    }
}

