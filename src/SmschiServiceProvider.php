<?php
namespace Alishojaeiir\Smschi;

use Illuminate\Support\ServiceProvider;

class SmschiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('smschi',function (){
            return new Smschi(config('smschi'));
        });

        $this->mergeConfigFrom(__DIR__.'/configs/smschiConfig.php','smschi');
    }
    public function boot(){
        $this->publishes([
            __DIR__.'/configs/smschiConfig.php' => config_path('smschi.php'),
        ]);
    }
}
