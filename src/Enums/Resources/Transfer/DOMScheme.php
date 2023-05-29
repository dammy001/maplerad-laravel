<?php

namespace Maplerad\Laravel\Enums\Resources\Transfer;

enum DOMScheme: string
{
    case DOM = 'DOM';
    case CASHPICKUP = 'CASHPICKUP';
    case MOBILEMONEY = 'MOBILEMONEY';
}
