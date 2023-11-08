<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Product;

class SiteMapProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:site-map-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate site map for products in yelsu.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        Product::all()->each(function (Product $productItem) use ($sitemap) {
            $sitemap->add(Url::create("/product/{$productItem->product_slug}"));
        });

        $sitemap->writeToFile(public_path('/sitemap/sitemap_products.xml'));
    }
}
