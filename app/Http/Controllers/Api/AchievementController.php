<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAchievementResponce;
use App\Models\Achievement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function getAll()
    {
        return Achievement::with(['children', 'parent'])->get();
    }

    public function detail(Achievement $achievement)
    {
        return $achievement->append('thumbnail_path');
    }

    public function create(StoreAchievementResponce $request, Achievement $achievement)
    {
        $achievement->fill($request->all(['name', 'description']));
        if($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('achievements/thumbnails', 'public');
            $achievement->thumbnail = $path;
        }
        $achievement->save();
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
