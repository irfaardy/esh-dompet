<?php

namespace Irfa\Dompet\Models;

use Illuminate\Database\Eloquent\Model;

class PinDompet extends Model
{
     protected $table = "dompet_pin";
     protected $fillable = ['pin','user_id'];
     protected $hidden = ['pin'];
}
