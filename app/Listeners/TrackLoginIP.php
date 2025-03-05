<?php

namespace App\Listeners;

use App\Models\LoginActivity;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Stevebauman\Location\Facades\Location;

class TrackLoginIP
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle(object $event): void
    // {
    //     //
    // }

    public function handle(Login $event)
{
    $user = $event->user;
    $ip = request()->ip();
    
    // Store basic IP
    // $user->update(['last_login_ip' => $ip]);
    $now=Carbon::now();

    // Advanced: Store with geolocation
    if ($position = Location::get($ip)) {
        LoginActivity::create([
            'user_id' => $user->id,
            'ip' => $ip,
            'country_code' => $position->countryCode,
            'city' => $position->cityName,
            'latitude' => $position->latitude,
            'longitude' => $position->longitude,
            'login_at'=>$now

        ]);
    }
}
}
