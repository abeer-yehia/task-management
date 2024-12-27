<?php

namespace App\Enums;

enum Status: string
{
    case Pending = 'Pending';
    case Completed = 'Completed';
    case Overdue = 'Overdue';

    // public function labels(): string
    // {
    //     return match ($this) {
    //         self::Pending         => "Pending",
    //         self::Completed       => "Completed",
    //         self::Overdue      => "Overdue",
    //     };
    // }
}
