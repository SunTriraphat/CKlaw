<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class LawTrack extends Model
{
    use HasFactory;
    protected $table = 'LawTrack';
    protected $fillable = ['id','CON_NO','tribunal','black_no','red_no','exe_office','case_type','levels','plaintiff','defendant1','defendant2','defendant3','event_start','event_end','law_id'];

 
   
}
