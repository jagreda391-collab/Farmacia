<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['business_name', 'ruc', 'phone', 'email', 'address'])]
class Supplier extends Model
{
    //
}