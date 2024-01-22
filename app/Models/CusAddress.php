<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;
use App\Models\Customer;

class CusAddress extends Model
{
    use HasFactory;
    protected $table = 'CusAddress';
    protected $fillable = ['id','HouseNumber','Moo','Region','District','Tumbon','Postcode','cus_id'];

    
    // public function ExecutionToCus()
    // {
    //     return $this->hasOne(Customer::class,'id','cus_id');
    // }
}
