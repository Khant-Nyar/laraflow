<?php

namespace KhantNyar\Laraflow;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use KhantNyar\Laraflow\Laraflow;

class LaraflowServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Filesystem $filesystem)
    {
        /*
         * Load views and Blade components
         */
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laraflow');
        Blade::anonymousComponentNamespace('laraflow.components', 'laraflow');

        if ($this->app->runningInConsole()) {
            // Publish views
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/laraflow'),
            ], 'views');

            // Publish assets (optional, if Flowbite assets are needed)
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laraflow'),
            ], 'assets');*/

            // Automatically install Flowbite dependencies and update app.js and app.css
            $this->installFlowbite($filesystem);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laraflow');

        // Register the main class to use with the facade
        $this->app->singleton('laraflow', function () {
            return new Laraflow;
        });
    }

    /**
     * Automatically install Flowbite dependencies and update app.js and app.css.
     */
    protected function installFlowbite(Filesystem $filesystem)
    {
        // Install the package via npm/yarn/pnpm/bun
        $this->runNodePackageManager();

        // Update app.js and app.css files
        $this->updateAssetFiles($filesystem);
    }

    /**
     * Run the appropriate package manager command based on lock file existence.
     */
    protected function runNodePackageManager()
    {
        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $this->runCommands(['pnpm install', 'pnpm run build']);
        } elseif (file_exists(base_path('yarn.lock'))) {
            $this->runCommands(['yarn install', 'yarn run build']);
        } elseif (file_exists(base_path('bun.lockb'))) {
            $this->runCommands(['bun install', 'bun run build']);
        } elseif (file_exists(base_path('deno.lock'))) {
            $this->runCommands(['deno install', 'deno task build']);
        } else {
            $this->runCommands(['npm install', 'npm run build']);
        }
    }

    /**
     * Update the app.js and app.css files to include Flowbite.
     */
    protected function updateAssetFiles(Filesystem $filesystem)
    {
        $jsPath = resource_path('js/app.js');
        $cssPath = resource_path('css/app.css');

        // Ensure Flowbite is imported in app.js
        if ($filesystem->exists($jsPath)) {
            $jsContent = $filesystem->get($jsPath);
            if (!Str::contains($jsContent, "import 'flowbite';")) {
                $filesystem->append($jsPath, "\nimport 'flowbite';");
            }
        }

        // Ensure Flowbite styles are imported in app.css
        if ($filesystem->exists($cssPath)) {
            $cssContent = $filesystem->get($cssPath);
            if (!Str::contains($cssContent, "@import 'flowbite';")) {
                $filesystem->append($cssPath, "\n@import 'flowbite';");
            }
        }
    }

    /**
     * Run terminal commands.
     *
     * @param array $commands
     */
    protected function runCommands(array $commands)
    {
        foreach ($commands as $command) {
            $process = proc_open($command, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
            if (is_resource($process)) {
                while ($output = fgets($pipes[1])) {
                    echo $output;
                }
                while ($error = fgets($pipes[2])) {
                    echo $error;
                }
                proc_close($process);
            }
        }
    }
}
