<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Filesystem\Filesystem;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('clean-storage', function() {
    $file = new Filesystem;
    $file->cleanDirectory('storage/app/public');
});