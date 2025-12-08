<?php

namespace App\Enums;

enum OfferStatus: string
{
    case PENDING = 'Pending';
    case ACCEPTED = 'Accepted';
    case REJECTED = 'Rejected';
    case CANCELLED = 'Cancelled';
    case COMPLETED = 'Completed';
}
