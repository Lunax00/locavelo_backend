<?php

namespace App\Enum;

enum UserStatus: string
{
    case Actif = 'Actif';
    case Sanctionne = 'Sanctionné';
}
