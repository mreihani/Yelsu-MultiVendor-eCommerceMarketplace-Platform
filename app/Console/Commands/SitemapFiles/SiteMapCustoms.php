<?php

namespace App\Console\Commands\SitemapFiles;

use Illuminate\Console\Command;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Customsoutlet;

class SiteMapCustoms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:site-map-customs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate site map for customs in yelsu.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()->add(Url::create('/customs/all'));

        Customsoutlet::all()->each(function (Customsoutlet $customsItem) use ($sitemap) {
            $sitemap->add(Url::create("/customs/details/{$customsItem->id}"));
        });

        $sitemap->writeToFile(public_path('/sitemap/sitemap_customs.xml'));
    }
}
