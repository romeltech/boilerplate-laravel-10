<?php

namespace App\Http\Controllers;

 
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Emailer; 
use Illuminate\Http\Request;
 

class EmailerController extends Controller
{ 

    public function saveEmailer(Request $request)
    {
        $result = Emailer::updateOrCreate(
            [
                'id' => $request['id']
            ],
            [
                'id' => $request['id'],
                'status' => $request['status'],
                'role' => $request['role'],
                'username' => $request['username'],
                'email' => $request['email'],
                'phone_no' => $request['phone_no'],
            ]
        );
        return response()->json([
            'message' => "Emailer updated successfully",
        ], 200);
    }

    public function getSingleEmailer($id)
    {
        $result = Emailer::where('id', $id)->first();
        return response()->json($result, 200);
    }

    public function getEmailers()
    { 
       $result = Emailer::paginate(10);
       return response()->json($result, 200);
    }

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
