<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Contract\PlanInterface;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(Request $request, PlanInterface $interface)
    {
        return response()->json(["models" => $interface->all($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function show($id, PlanInterface $interface)
    {
        return response()->json(["model" => $interface->findById($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

}