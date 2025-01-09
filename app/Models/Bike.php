<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enum\BikeState;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_velo_id',
        'state',
        'station_id',
    ];

    /**
     * Casts for the model attributes.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'state' => 'string', // Utilisation de l'énumération
    ];

    public function typeVelo()
    {
        return $this->belongsTo(TypeVelo::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
