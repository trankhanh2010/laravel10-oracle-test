<?php

namespace App\Models\HIS;

use App\Traits\dinh_dang_ten_truong;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedLog extends Model
{
    use HasFactory, dinh_dang_ten_truong;
    protected $connection = 'oracle_his'; 
    protected $table = 'HIS_BED_LOG';
    protected $fillable = [

    ];
}
