<?php

namespace App\Console\Commands\SitemapFiles;

use Illuminate\Console\Command;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\User;

class SiteMapRetailer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:site-map-retailer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate site map for retailer in yelsu.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()->add(Url::create('/retailer/all'));

        User::where('role','retailer')->where('status','active')->each(function (User $userItem) use ($sitemap) {
            $sitemap->add(Url::create("/retailer/details/{$userItem->id}"));
        });

        $sitemap->writeToFile(public_path('/sitemap/sitemap_retailers.xml'));
    }
}