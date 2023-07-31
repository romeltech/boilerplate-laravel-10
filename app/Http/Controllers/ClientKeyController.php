<?php

namespace App\Http\Controllers;

use App\Models\ClientKey;
use Illuminate\Http\Request;

class ClientKeyController extends Controller
{
    public function saveKey(Request $request)
    {
        $clientKey = ClientKey::firstOrCreate([
            'key' => $request['key'],
            'user_id' => $request['user_id'] ? $request['user_id'] : null,
        ]);

        return response()->json([
            "message" => 'Key saved successfully',
            "client" => $clientKey
        ], 200);
    }

    public function removeKey(Request $request)
    {
        $clientKey = ClientKey::where([
            'key' => $request['key'],
        ])->delete();

        return response()->json([
            "message" => 'Key removed successfully',
            "client" => $clientKey
        ], 200);
    }
}
