<?php

namespace App\Http\Modules\Equipment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['type_id', 'comment', 'serial_number'];
    protected $guarded = ['id'];
}
