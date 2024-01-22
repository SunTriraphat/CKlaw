<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class TrackingDetail extends Model
{
    use HasFactory;
    protected $table = 'TrackingDetail';
    protected $fillable = ['id','date_tag','com_id','userInsert','status'];

}
