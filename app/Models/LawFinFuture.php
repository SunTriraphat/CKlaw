<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_privilege;

class LawFinFuture extends Model
{
    use HasFactory;
    protected $table = 'LawFinFuture';
    protected $fillable = ['id','userInsert','amount','detail'];

    public function LawFinToUser()
    {
        return $this->hasOne(User::class,'id','userInsert');
    }

}
