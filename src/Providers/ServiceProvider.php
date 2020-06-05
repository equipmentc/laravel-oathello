<?php
namespace Equipmentc\Oathello\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/oathello.php' => config_path('oathello.php'),
        ], 'oathello');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-oathello');

        Blade::directive('document', function ($expression) {
            $params = explode(',', str_replace(['\'',' '], '', $expression));
            $data = "[
                'session'  => '".$params[0]."',
                'document' => '".$params[1]."',
                ".(isset($params[2]) ? "'signer' => '".$params[2]."'" : '')."
            ]";

            return "<?php echo view('laravel-oathello::document', ".$data.")->render(); ?>";
        });

        Blade::directive('onDocumentSigned', function ($expression) {
            return "<script>oathello.onDocumentSigned = () => {";
        });

        Blade::directive('endonDocumentSigned', function ($expression) {
            return "};</script>";
        });

        Blade::directive('onSessionFinished', function ($expression) {
            return "<script>oathello.onSessionFinished = () => {";
        });

        Blade::directive('endonSessionFinished', function ($expression) {
            return "};</script>";
        });
    }
}
