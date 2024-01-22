<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class UploadFile extends Model
{
    use HasFactory;
    protected $table = 'UploadFile';
    protected $fillable = ['id','file_path','cus_id'];
}
