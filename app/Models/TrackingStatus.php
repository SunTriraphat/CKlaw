<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class TrackingStatus extends Model
{
    use HasFactory;
    protected $table = 'TrackingStatus';
    protected $fillable = ['id','status'];

}
