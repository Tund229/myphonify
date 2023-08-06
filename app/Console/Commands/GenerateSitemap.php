<?php

namespace App\Console\Commands;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        // Ajoutez les URLs que vous souhaitez indexer dans le sitemap
        $sitemap
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/login')->setPriority(0.8))
            ->add(Url::create('/register')->setPriority(0.8));
    
        // Ajoutez d'autres URLs si nécessaire
    
        // Écrivez le sitemap dans le fichier sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));
    
        $this->info('Sitemap generated successfully!');
    }
}
