<?php

namespace App\Enums;

enum Priority: string
{
    case Low = 'Low';
    case Medium = 'Medium';
    case High = 'High';


    public function labels(): string
    {
        return match ($this) {
            self::Low         => "Low",
            self::Medium       => "Medium",
            self::High      => "High",
        };
    }

    // public function previous(): ?self
    // {
    //     return match ($this) {
    //         self::High => self::Medium,
    //         self::Medium => self::Low,
    //         default => null,
    //     };
    // }

    // public function next(): ?self
    // {
    //     return match ($this) {
    //         self::Low => self::Medium,
    //         self::Medium => self::High,
    //         default => null,
    //     };
    // }
}
