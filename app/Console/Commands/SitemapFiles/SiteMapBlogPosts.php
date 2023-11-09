<?php

namespace App\Console\Commands\SitemapFiles;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\BlogPost;

class SiteMapBlogPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:site-map-blog-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate site map for blog posts in yelsu.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()->add(Url::create('/blog'));

        BlogPost::all()->each(function (BlogPost $blogItem) use ($sitemap) {
            $sitemap->add(Url::create("/blog/{$blogItem->post_slug}"));
        });

        $sitemap->writeToFile(public_path('/sitemap/sitemap_blogs.xml'));
    }
}
