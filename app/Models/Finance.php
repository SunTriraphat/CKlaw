<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class Finance extends Model
{
    use HasFactory;
    protected $table = 'Finance';
    protected $fillable = ['id','cus_id','court_fee','send_defendant','mandatory_fee','copy_documents1','check_ownership','copy_documents2','point_property','date_fin','id_finFuture'];

 
    public function FinanceToCus()
    {
        return $this->hasOne(Customer::class,'id','cus_id');
    }
    public function FinanceToFinOther()
    {
        return $this->hasMany(FinanceOther::class,'FinId','id');
    }

    public static function generateFinnumber(){
        $Bill = Finance::whereYear('date_fin',date('Y'))->latest('id')->first();
       
        if($Bill != NULL){
            $StrNum = substr($Bill->bil_no, -4) + 1;
            $num = "1000";
            $SubStr = substr($num.$StrNum, -4);
           
            if (substr($Bill->date_fin,5,2) != date('m')) {
                $CodeBill = 'LAW-'.substr(date('Y'),2,2).date('m').'0001';
            }else {
                $CodeBill = 'LAW-'.substr(date('Y'),2,2).date('m').$SubStr;
            }
        }else{
            $CodeBill = 'LAW-'.auth()->user()->zone.substr(date('Y'),2,2).date('m').'0001';
        }
        return $CodeBill;
    }
}
