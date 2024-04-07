<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'Reservation';
    protected $primaryKey = 'IDRESERVATION';
    public $timestamps = false;
    public function service() {
        return $this->belongsTo(Service::class, 'IDSERVICE', 'IDSERVICE');
    }


}
