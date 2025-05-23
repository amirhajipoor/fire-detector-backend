<?php

namespace App\Models;

use App\Enums\ReportLevel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => ReportLevel::class,
        ];
    }

    protected function level(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $gas = $attributes['value'];

                if ($gas > 450 && $gas <= 550) {
                    return ReportLevel::LOW;

                } elseif ($gas > 550 && $gas <= 650) {
                    return ReportLevel::MEDIUM;

                } elseif ($gas > 650) {
                    return ReportLevel::HIGH;
                }
            }
        );
    }
}
