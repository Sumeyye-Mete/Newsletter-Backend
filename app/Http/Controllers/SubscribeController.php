<?php

namespace App\Http\Controllers;

use App\Models\Subscribes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            "email" => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('subscribes', 'email')],
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => 422,
                "message" => $validator->messages(),
            ];
            return response()->json($data, 422);
        }

        $email = Subscribes::create([
            'email' => $request->input('email'),
        ]);
        if ($email) {
            return response()->json(['message' => 'Email added successfully'], 200);
        } else {
            return response()->json(['message' => 'Something went wrong']);
        }
    }
}
