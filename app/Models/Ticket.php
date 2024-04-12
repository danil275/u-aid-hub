<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'title', 'text'];

    protected function casts(): array
    {
        return [
            'status' => TicketStatus::class,
            'escalation_time' => 'datetime',
            'escalation_update_time' => 'datetime',
            'escalation_response_time' => 'datetime',
            'escalation_solution_time' => 'datetime',
        ];
    }
}
