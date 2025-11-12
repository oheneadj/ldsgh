<?php

namespace App\Enums;

enum PaymentMethodEnum:string
{
   case CARD = 'card';
    case MTN = 'mtn_mobile_money';

    case TELECEL = 'telecel_cash';

    case AIRTELTIGO = 'airteltigo_cash';

    case CASH = 'cash';
    case BANK_TRANSFER = 'bank_transfer';
}
