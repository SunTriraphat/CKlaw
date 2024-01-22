<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class Tribunal_status extends Model
{
    use HasFactory;
    protected $table = 'Tribunal_status';
    protected $fillable = ['id','status_1','status_1','status_1','status_1','status_1','status_1','cus_is'];
}
