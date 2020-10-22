<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $connection = 'oracle';
    protected $table = 'ipc_portal.dealers';
    protected $primaryKey = 'id';
}
