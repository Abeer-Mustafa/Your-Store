<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->includeHelpers(app_path('Helpers'));
    }

    // =========== include files in Helpers folder for composer ===========
    public function includeHelpers($path) {
        $pathFolders = scandir($path);
        for ($i=2; $i < count($pathFolders) ; $i++)
        {
            if (is_dir($path.'/'.$pathFolders[$i]))
                $this->includeHelpers($path.'/'.$pathFolders[$i]);
            elseif (is_file($path.'/'.$pathFolders[$i]))
                @require_once $path.'/'.$pathFolders[$i];
        }
    }
}
