<?php

namespace App\Enums;

enum VehicleStatusEnum:string
{
    case AVAILABLE = "available";
    case UNDER_MAINTENANCE = "under_maintenance";
    case STOLEN = "stolen";
    case UNUSABLE = "unusable";
}


