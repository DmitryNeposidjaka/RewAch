<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Tag::all());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);
        Tag::create($request->only(['name']));
        return response()->json(['message' => 'Tag created successful'])->setStatusCode(201);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Tag $tag)
    {
        return response()->json($tag->load('achievements'));
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);
        $tag->update($request->only('name'));
        return response()->json(['message' => 'Tag successful updated'])->setStatusCode(200);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['message' => 'Tag deleted successful'])->setStatusCode(204);
    }
}
