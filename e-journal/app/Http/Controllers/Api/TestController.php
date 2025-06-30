<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testToken(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Token validation works!',
            'data' => [
                'timestamp' => now()->toDateTimeString()
            ]
        ]);
    }
    
    public function testPublic()
    {
        return response()->json([
            'success' => true,
            'message' => 'Public endpoint works!',
            'timestamp' => now()->toDateTimeString()
        ]);
    }
}
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        return response()->json([
            'success' => true,
            'message' => 'API is working!',
            'timestamp' => now()
        ]);
    }
}
