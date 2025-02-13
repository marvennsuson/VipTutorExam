<?php

use App\Console\Commands\UpdateProductCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\DeleteProductCommand;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(UpdateProductCommand::class)->everySixHours();
Schedule::command(DeleteProductCommand::class)
->weeklyOn(1, '00:00'); 