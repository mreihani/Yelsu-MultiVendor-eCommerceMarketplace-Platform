<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


class SiteMapPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:site-map-pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate site map for pages in yelsu.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/anti-money-laundering-law'))
        ->add(Url::create('/about-us'))
        ->add(Url::create('/contact-us'))
        ->add(Url::create('/encom-galaxy'))
        ->add(Url::create('/galaxy-petrol'))
        ->add(Url::create('/financing-the-purchase-of-goods'));

        $sitemap->writeToFile(public_path('/sitemap/sitemap_pages.xml'));
    }

}
