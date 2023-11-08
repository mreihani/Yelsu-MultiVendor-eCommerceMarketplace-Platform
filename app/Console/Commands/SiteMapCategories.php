<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Category;

class SiteMapCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:site-map-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate site map for categories in yelsu.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()->add(Url::create('/shop'));

        Category::all()->each(function (Category $categoryItem) use ($sitemap) {
            $sitemap->add(Url::create("/shop/category?id={$categoryItem->id}"));
        });

        $sitemap->writeToFile(public_path('/sitemap/sitemap_categories.xml'));
    }
}
