<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebasePushController extends Controller
{
    protected $notification;

    // https://www.iankumu.com/blog/laravel-firebase-push-notification/

    public function __construct()
    {
        $this->notification = Firebase::messaging();
    }

    public function setToken(Request $request)
    {
        $user = auth('sanctum')->user()->update(['fcm_token' => $request['fcm_token']]);
        return response()->json([
            'message' => $user ? 'Success' : 'Failed',
        ]);
    }

    public function sendNotification(Request $request)
    {
        // $FcmToken = auth('sanctum')->user->fcm_token;
        $user = User::where('id', 1)->first();
        $message = CloudMessage::fromArray([
            'token' => $user->fcm_token,
            'notification' => [
                'title' => 'MEL Push Notification',
                'body' => "This is a test notification",
                // 'icon' => "https%3A%2F%2Fromel.tech%2Fri-fav.png",
                // 'badge' => "https%3A%2F%2Fromel.tech%2Fri-fav.png"
                ],
        ]);

        $this->notification->send($message);

        return response()->json([
            'token' => $user->fcm_token,
            'message' => $message,
        ]);
    }
}
