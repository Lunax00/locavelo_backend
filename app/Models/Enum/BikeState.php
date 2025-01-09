<?php

namespace App\Enum;

enum BikeState: string
{
    case Disponible = 'Disponible';
    case EnReparation = 'En réparation';
    case HorsService = 'Hors service';
}
