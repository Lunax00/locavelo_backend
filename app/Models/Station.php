<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bike;

class Station extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'address',
        'capacity',
        'coordinates',
        'image', // Ajout des coordonnées
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'coordinates' => 'array', // Cast JSON en tableau associatif PHP
    ];

    /**
     * Get latitude from coordinates.
     */
    public function getLatitudeAttribute(): ?float
    {
        return $this->coordinates['latitude'] ?? null;
    }

    /**
     * Get longitude from coordinates.
     */
    public function getLongitudeAttribute(): ?float
    {
        return $this->coordinates['longitude'] ?? null;
    }

    /**
     * Set coordinates using latitude and longitude.
     */
    public function setCoordinates(float $latitude, float $longitude): void
    {
        $this->attributes['coordinates'] = json_encode([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}
