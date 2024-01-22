<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;
use App\Models\Customer;

class Execution_debt extends Model
{
    use HasFactory;
    protected $table = 'Execution_debt';
    protected $fillable = ['id','cus_id','exe_status','status','exe_date'];

    
    public function ExecutionToCus()
    {
        return $this->hasOne(Customer::class,'id','cus_id');
    }
}
