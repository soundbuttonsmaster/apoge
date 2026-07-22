<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class PublishScheduledBlogs extends Command
{
    protected $signature = 'blogs:publish-scheduled';

    protected $description = 'Publish blogs whose scheduled_at datetime has been reached';

    public function handle()
    {
        $now = Carbon::now(config('app.timezone'));

        $blogs = Blog::query()
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', $now)
            ->where(function ($q) {
                $q->where('status', 0)->orWhere('status', '0');
            })
            ->get();

        if ($blogs->isEmpty()) {
            $this->info('No scheduled blogs to publish.');
            return 0;
        }

        foreach ($blogs as $blog) {
            $blog->status = 1;
            $blog->save();
            $this->info('Published: #' . $blog->id . ' ' . $blog->title);
        }

        $this->info('Done. Published ' . $blogs->count() . ' blog(s).');
        return 0;
    }
}
