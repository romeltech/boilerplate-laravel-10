<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function saveProfile(Request $request)
    {
        $profileArray = array(
            'full_name' => $request['full_name'],
            'dob' => $request['dob'],
            'nationality' => $request['nationality'],
        );
        $profile = Profile::updateOrCreate([
            'user_id' => $request['id'],

        ], $profileArray);


        $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
            "instanceId" => "a9bdb868-c750-495a-9107-128cccb629d6",
            "secretKey" => "84FCE6FD458A8EFCAE24BEACEFA65A98B84AF0F66693B778D3FE67D766505661",
        ));

        $publishResponse = $beamsClient->publishToInterests(
            array("app"),
            array("web" => array("notification" => array(
              "title" => "Hello",
              "body" => "Hello, World!",
              "deep_link" => "http://localhost:8000/admin/users",
              "icon" => "https://romel.tech/ri-fav.png"
            )),
        ));

        return response()->json([
            'message' => 'Profile saved successfully',
            'profile' => $profile,
            'beamsClient' => $beamsClient,
            'publishResponse' => $publishResponse,
        ], 200);
    }

    public function getProfileById($id)
    {
        $profile = Profile::where('user_id', $id)->first();
        return response()->json($profile, 200);
    }
}
