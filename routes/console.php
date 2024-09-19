<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('db:rebuild', function () {
    $this->comment('Wiping the database...');
    Artisan::call('migrate:fresh');
    $this->comment('Seeding the database...');
    Artisan::call('db:seed');
    $this->comment('Database has been rebuilt successfully.');
})->purpose('Wipe, migrate, and seed the database');
