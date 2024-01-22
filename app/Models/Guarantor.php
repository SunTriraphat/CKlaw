<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class Guarantor extends Model
{
    use HasFactory;
    protected $table = 'Guarantor';
    protected $fillable = ['id','cus_id','prefix','name','surname','ID_num','PhoneNum'];

 

    public function GuarantorToCus()
    {
        return $this->hasOne(Customer::class,'id','cus_id');
    }
}
