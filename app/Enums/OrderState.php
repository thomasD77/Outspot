<?php
namespace App\Enums;


enum OrderState : string
{
    case Paid = 'Paid';
    case Pending = 'Pending';
    case Canceled = 'Canceled';
}
