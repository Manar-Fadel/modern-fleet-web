<?php

namespace App\Enums;

enum OfferStatus: string
{
    case PENDING = 'Pending';
    case ACCEPTED = 'Accepted';
    case REJECTED = 'Rejected';
    case PAID = 'Paid';
    case IN_DELIVERY = 'In Delivery';
}
