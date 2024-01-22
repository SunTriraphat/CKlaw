<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class TrackingMinimum extends Model
{
    use HasFactory;
    protected $table = 'TrackingMinimum';
    protected $fillable = ['num','minimum'];

}
