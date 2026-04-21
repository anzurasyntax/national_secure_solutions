<?php

namespace App\Models;

use App\Enums\CourseOrderStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[Fillable([
    'uuid',
    'course_id',
    'user_id',
    'buyer_email',
    'buyer_name',
    'amount',
    'currency',
    'status',
    'payment_gateway',
    'gateway_reference',
    'meta',
    'paid_at',
])]
class CourseOrder extends Model
{
    protected static function booted(): void
    {
        static::creating(function (CourseOrder $order): void {
            if ($order->uuid === null || $order->uuid === '') {
                $order->uuid = (string) Str::uuid();
            }
        });
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'meta' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    public function isPaid(): bool
    {
        return $this->status === CourseOrderStatus::Paid->value;
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
