<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPickupNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // or push
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'vendor_codes' => $this->order->vendorOrders->pluck('vendor_order_code'),
            'pickup_location' => $this->order->vendorOrders->pluck('vendor.location'),
        ];
    }
}
