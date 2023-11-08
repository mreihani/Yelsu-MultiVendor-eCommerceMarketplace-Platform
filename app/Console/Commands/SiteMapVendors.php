<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\User;

class SiteMapVendors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:site-map-vendors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate site map for vendors in yelsu.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()->add(Url::create('/vendor/all'));

        User::where('role','vendor')->where('status','active')->each(function (User $userItem) use ($sitemap) {
            $sitemap->add(Url::create("/vendor/details/{$userItem->id}"));
        });

        $sitemap->writeToFile(public_path('/sitemap/sitemap_vendors.xml'));
    }
}
