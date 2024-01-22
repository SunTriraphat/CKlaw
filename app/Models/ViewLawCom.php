<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class ViewLawCom extends Model
{
    use HasFactory;
    protected $table = 'LawCom';
    // protected $fillable = ['id','type','pay_amount','due_date','interest','totalSum','pay_balance','status'];

    public function ViewComToInstall()
    {
        return $this->hasMany(ComInstall::class,'com_id','id');
    }
    public function ViewComToTeamFollow()
    {
        return $this->hasOne(TeamFollow::class,'com_id','com_id');
    }
    public function ViewComToFin()
    {
        return $this->hasOne(ComFinance::class,'cus_id','cus_id')->latest();
    }
}
