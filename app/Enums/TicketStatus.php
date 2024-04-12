<?php

namespace App\Enums;


enum TicketStatus: string
{
    case Close = 'Закрыта';
    case Open = 'Открыта';
    case New = 'Новая';
}
