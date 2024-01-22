<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class TeamFollow extends Model
{
    use HasFactory;
    protected $table = 'TeamFollow';
    protected $fillable = ['id','name','com_id','user_id','status'];
    public function TeamFollowToCus()
    {
        return $this->hasOne(Customer::class,'id','cus_id');
    }
    
}
