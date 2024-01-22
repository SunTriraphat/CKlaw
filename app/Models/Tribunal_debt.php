<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class Tribunal_debt extends Model
{
    use HasFactory;
    protected $table = 'Tribunal_debt';
    protected $fillable = ['id','tribunal','case_type','black_no','capital_sue','date_tribunal','File_path','File_upload','date_witness'];

    public function TribunalToCus()
    {
        return $this->hasOne(Customer::class,'id','cus_id');
    }
}
