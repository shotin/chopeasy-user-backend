<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function vendorNotifications(Request $request)
    {
        $user = $request->user();

        if (!$user || $user->user_type !== 'vendor') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notifications = $user->notifications()
            ->latest()
            ->limit(50)
            ->get()
            ->map(function ($notification) {
                $data = is_array($notification->data)
                    ? $notification->data
                    : (json_decode($notification->data, true) ?: []);

                $orderId = $data['order_id'] ?? null;
                $title = $data['title'] ?? 'New Notification';
                $message = $data['message'] ?? ($orderId
                    ? "Order #{$orderId} has an update."
                    : 'You have a new notification.');

                return [
                    'id' => $notification->id,
                    'type' => $data['type'] ?? 'info',
                    'title' => $title,
                    'message' => $message,
                    'timestamp' => $notification->created_at,
                    'read' => !is_null($notification->read_at),
                    'data' => $data,
                ];
            })
            ->values();

        return response()->json([
            'notifications' => $notifications,
        ]);
    }

    public function markAllAsRead(Request $request)
    {
        $user = $request->user();

        if (!$user || $user->user_type !== 'vendor') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $count = $user->unreadNotifications()->count();
        $user->unreadNotifications->markAsRead();

        return response()->json([
            'message' => 'Notifications marked as read.',
            'updated_count' => $count,
        ]);
    }
}

