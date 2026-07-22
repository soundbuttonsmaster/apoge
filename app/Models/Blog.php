<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'full_description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'head_content',
        'status',
        'scheduled_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    /**
     * Waiting for a future publish time (hidden from public site).
     */
    public function isScheduled(): bool
    {
        return $this->scheduled_at
            && $this->scheduled_at->isFuture()
            && (int) $this->status !== 1;
    }

    /**
     * Flip due scheduled blogs to active (works even if cron is not running).
     */
    public static function publishDue(): int
    {
        return static::dueForPublish()->update(['status' => 1]);
    }

    /**
     * Visible on the public website.
     * Active + schedule null/past. Future-scheduled posts stay hidden.
     */
    public function scopePublished($query)
    {
        $now = Carbon::now(config('app.timezone'));

        return $query
            ->where(function ($q) {
                $q->where('status', 1)->orWhere('status', '1');
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('scheduled_at')
                    ->orWhere('scheduled_at', '<=', $now);
            });
    }

    public function scopeDueForPublish($query)
    {
        $now = Carbon::now(config('app.timezone'));

        return $query
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', $now)
            ->where(function ($q) {
                $q->where('status', 0)->orWhere('status', '0');
            });
    }
}
