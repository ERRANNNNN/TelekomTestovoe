<?php

namespace App\Http\Modules\Equipment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where()
 * @method static find(int $typeID)
 * @method static when(bool $param, \Closure $param1)
 */
class Equipment_types extends Model
{
    use HasFactory;

    public $timestamps = false;
}
