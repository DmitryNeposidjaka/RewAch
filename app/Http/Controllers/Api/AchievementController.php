<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAchievementResponce;
use App\Models\Achievement;
use App\Http\Controllers\Controller;

/**
 * Class AchievementController
 * @package App\Http\Controllers\Api
 */
class AchievementController extends Controller
{
    /** Get All Achievement
     * @return Achievement[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Achievement::with(['children', 'parent'])->get();
    }

    /** Get Achievement with detail
     * @param Achievement $achievement
     * @return Achievement
     */
    public function detail(Achievement $achievement)
    {
        return $achievement->append('thumbnail_path')->load(['children', 'parent', 'approves']);
    }

    /** Create Achievement
     * @param StoreAchievementResponce $request
     * @param Achievement $achievement
     * @return \Illuminate\Http\JsonResponse
     */
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

    /** Update Achievement
     * @param StoreAchievementResponce $request
     * @param Achievement $achievement
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreAchievementResponce $request, Achievement $achievement)
    {
        if($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('achievements/thumbnails', 'public');
            $achievement->thumbnail = $path;
        }
        $achievement->update($request->all(['name', 'description']));
        return response()->json(['message' => 'Achievement updated successful']);
    }

    /** Delete Achievement
     * @param Achievement $achievement
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Achievement $achievement)
    {
        $achievement->delete();
        return response()->json(['message' => 'Achievement deleted successful']);
    }
}
