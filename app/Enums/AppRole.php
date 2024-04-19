<?php

namespace App\Enums;

enum AppRole: string
{
    case Admin = 'Админ';
    case Agent = 'Агент';
    case Client = 'Клиент';
}