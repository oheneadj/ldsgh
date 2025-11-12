<?php

namespace App\Enums;

enum ServiceRequestStatusEnum :string
{
    case PENDING = 'pending';
    case ASSIGNED = 'assigned';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
