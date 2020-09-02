<?php

namespace Irfa\Dompet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
	use SoftDeletes;
    protected $table = "request_withdrawal";
    protected $fillable = ['balance','note','is_approve','is_canceled'];
}
