<?php

namespace App\Enums;

enum ServiceRequestTypeEnum:string
{
     case RIDE = 'ride';
    case PACKAGE = 'package';
    case EXPRESS = 'express';
}
