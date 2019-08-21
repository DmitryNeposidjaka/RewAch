<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAchievementResponce;
use App\Models\Achievement;
use App\Http\Controllers\Controller;

class AchievementController extends Controller
{
    public function getAll()
    {
        return Achievement::with(['children', 'parent'])->get();
    }

    public function detail(Achievement $achievement)
    {
        return $achievement;
    }

    public function create(StoreAchievementResponce $request)
    {
        (new Achievement($request->all(['name', 'description'])))->save();
        return response()->json(['message' => 'Achievement created successful']);
    }

    public function update(StoreAchievementResponce $request, Achievement $achievement)
    {
        $achievement->update($request->all(['name', 'description']));
        return response()->json(['message' => 'Achievement updated successful']);
    }

    public function delete(Achievement $achievement)
    {
        $achievement->delete();
        return response()->json(['message' => 'Achievement deleted successful']);
    }
}
