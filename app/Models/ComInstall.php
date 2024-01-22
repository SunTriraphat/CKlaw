<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class ComInstall extends Model
{
    use HasFactory;
    protected $table = 'ComInstall';
    protected $fillable = ['id','type','pay_amount','due_date','interest','totalSum','pay_balance','status'];
}
