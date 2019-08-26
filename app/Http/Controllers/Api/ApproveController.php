<?php

namespace App\Http\Controllers\Api;

use App\Models\Approve;
use App\Http\Controllers\Controller;

class ApproveController extends Controller
{
    public function getAll()
    {
        return Approve::all();
    }
}
