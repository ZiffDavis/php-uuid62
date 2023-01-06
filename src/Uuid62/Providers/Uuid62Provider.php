<?php
namespace ZiffDavis\Uuid62\Providers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class Uuid62Provider extends ServiceProvider
{
    public function boot()
    {
        Blueprint::macro('uuid62Primary', function($label = 'uuid') {
            return $this->char($label, 23)->charset('utf8')->collation('utf8_bin')->primary();
        });

        Blueprint::macro('uuid62', function($label) {
            return $this->char($label, 23)->charset('utf8')->collation('utf8_bin')->unique();

        });
    }

    public function register()
    {

    }
}