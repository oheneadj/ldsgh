<?php

namespace App\Enums;

enum VehicleConditionEnum: string
{
    case NEW = 'new';
    case GOOD = 'good';
    case FAIR = 'fair';
    case POOR = 'poor';
}
