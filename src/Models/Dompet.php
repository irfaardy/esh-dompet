<?php

namespace Irfa\Dompet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dompet extends Model
{
	use SoftDeletes;
    protected $table = "dompet";
    protected $fillable = ['balance','annotation','user_id','transaction_id'];
}
