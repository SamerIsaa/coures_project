<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//
//Artisan::command('a' , function (){
//    // make my action
//});

//Schedule::call(function () {
//    Artisan::call('app:check-ended-subscription-command');
//
//})->dailyAt('00:00');





//Artisan::command('app:check-ended-subscription-command');

