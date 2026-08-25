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

    /**
     * Stem used for generated OG / social featured JPGs.
     */
    public function featuredImageStem(): string
    {
        if (!empty($this->image)) {
            return pathinfo($this->image, PATHINFO_FILENAME);
        }

        return (string) ($this->slug ?: $this->id);
    }

    /**
     * Absolute public path to generated featured JPG if present.
     */
    public function featuredImagePath(): ?string
    {
        $path = public_path('uploads/blog/featured/' . $this->featuredImageStem() . '.jpg');

        return is_file($path) ? $path : null;
    }

    /**
     * URL for social / OG image (generated featured → static default).
     */
    public function ogImageUrl(): string
    {
        if ($this->featuredImagePath()) {
            return asset('uploads/blog/featured/' . $this->featuredImageStem() . '.jpg');
        }

        if (is_file(public_path('front/images/apogee-blog-featured.webp'))) {
            return asset('front/images/apogee-blog-featured.webp');
        }

        return asset('front/images/laser-land-leveller.png');
    }

    /**
     * Inject heading ids and return TOC items from full_description (h1–h6).
     *
     * @return array{html: string, items: array<int, array{id: string, text: string, level: int}>}
     */
    public function withTableOfContents(): array
    {
        $html = (string) ($this->full_description ?? '');
        $items = [];

        if ($html === '') {
            return ['html' => '', 'items' => []];
        }

        $usedIds = [];

        $html = preg_replace_callback(
            '/<(h([1-6]))(\s[^>]*)?>(.*?)<\/\1>/is',
            function ($m) use (&$items, &$usedIds) {
                $tag = strtolower($m[1]);
                $level = (int) $m[2];
                $attrs = $m[3] ?? '';
                $inner = $m[4];
                $text = trim(html_entity_decode(strip_tags($inner), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

                if ($text === '') {
                    return $m[0];
                }

                $id = null;
                if (preg_match('/\sid\s*=\s*(["\'])(.*?)\1/i', $attrs, $idMatch)) {
                    $id = $idMatch[2];
                }

                if (!$id) {
                    $base = \Illuminate\Support\Str::slug($text) ?: 'section';
                    $id = $base;
                    $n = 2;
                    while (isset($usedIds[$id])) {
                        $id = $base . '-' . $n;
                        $n++;
                    }
                    $attrs = rtrim($attrs) . ' id="' . e($id) . '"';
                }

                $usedIds[$id] = true;
                $items[] = [
                    'id' => $id,
                    'text' => $text,
                    'level' => $level,
                ];

                return '<' . $tag . $attrs . '>' . $inner . '</' . $tag . '>';
            },
            $html
        );

        return [
            'html' => $html ?? (string) $this->full_description,
            'items' => $items,
        ];
    }
}
