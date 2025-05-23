<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ReportLevel: string implements HasColor, HasLabel
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => __('crud.level.low'),
            self::MEDIUM => __('crud.level.medium'),
            self::HIGH => __('crud.level.high'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::LOW => 'yellow',
            self::MEDIUM => 'orange',
            self::HIGH, => 'red',
        };
    }
}
