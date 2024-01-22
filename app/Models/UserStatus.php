<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class UserStatus extends Model
{
    use HasFactory;
    protected $table = 'UserStatus';
    protected $fillable = ['id','name'];

}
