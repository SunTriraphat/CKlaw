<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class CloseDetail extends Model
{
    use HasFactory;
    protected $table = 'CloseDetail';
    protected $fillable = ['id','totalSum','cus_id','discount','total_pay','status','discountApp'];
}
