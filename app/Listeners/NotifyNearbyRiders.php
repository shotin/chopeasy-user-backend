<?php

namespace App\Listeners;

use App\Events\OrderReadyForPickup;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewPickupNotification;

class NotifyNearbyRiders
{
    public function handle(OrderReadyForPickup $event)
    {
        $order = $event->order;

        $riders = User::where('user_type', 'rider')
            ->whereRaw("
        ST_Distance_Sphere(
            point(longitude, latitude), 
            point(?, ?)
        ) < ?
    ", [
                $order->vendorOrders->first()->vendor->longitude,
                $order->vendorOrders->first()->vendor->latitude,
                5000 
            ])
            ->get();
        Notification::send($riders, new NewPickupNotification($order));
    }
}
