<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class Plaintiff extends Model
{
    use HasFactory;
    protected $table = 'Plaintiff';
    protected $fillable = ['name'];

}
