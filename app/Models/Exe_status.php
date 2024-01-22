<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;
use App\Models\Customer;

class Exe_status extends Model
{
    use HasFactory;
    protected $table = 'Exe_status';
    protected $fillable = ['id','cus_id','status_1'];

    
    // public function ExecutionToCus()
    // {
    //     return $this->hasOne(Customer::class,'id','cus_id');
    // }
}
