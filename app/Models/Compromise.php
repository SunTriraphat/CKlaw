<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class Compromise extends Model
{
    use HasFactory;
    protected $table = 'Compromise';
    protected $fillable = ['id','created_at','updated_at','type_com','date_com','pay_com','pay_first','installments','period','discount'];
    public function ComToComFin()
    {
        return $this->hasMany(ComFinance::class,'cus_id','cus_id');
    }
    public function ComToComInstall()
    {
        return $this->hasMany(ComInstall::class,'com_id','id');
    }
    public function ComToTeamFollow()
    {
        return $this->hasMany(TeamFollow::class,'com_id','id');
    }
    public function ComToTeamExe()
    {
        return $this->hasOne(Execution_debt::class,'cus_id','cus_id')->latest();
    }
  
}
