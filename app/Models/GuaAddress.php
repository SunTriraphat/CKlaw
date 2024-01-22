<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;
use App\Models\Customer;

class GuaAddress extends Model
{
    use HasFactory;
    protected $table = 'GuaAddress';
    protected $fillable = ['id','HouseNumber','Moo','Region','District','Tumbon','Postcode','gua_id'];

    
    // public function ExecutionToCus()
    // {
    //     return $this->hasOne(Customer::class,'id','cus_id');
    // }
}
