<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'Customer';
    protected $fillable = ['id','CON_NO','name','surname','status_tribunal','status_com','status_close'];
    public function CusToFinance()
    {
        return $this->hasOne(Finance::class,'cus_id','id');
    }
    public function CusToGua()
    {
        return $this->hasMany(Guarantor::class,'cus_id','id');
    }
    public function CusToCom()
    {
        
        return $this->hasOne(Compromise::class,'cus_id','id')->latest();
    }
    public function CusToTri()
    {
        
        return $this->hasOne(Tribunal_debt::class,'cus_id','id')->latest();
    }
    public function CusToClose()
    {
        
        return $this->hasOne(CloseDetail::class,'cus_id','id')->latest();
    }
    public function CusToExe()
    {
        
        return $this->hasOne(Execution_debt::class,'cus_id','id')->latest();
    }
}
