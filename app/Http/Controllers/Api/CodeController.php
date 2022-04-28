<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Contract\CodeInterface;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function index(Request $request, CodeInterface $interface)
    {
        return response()->json(["model" => $interface->all($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function show($id, CodeInterface $interface)
    {
        return response()->json(["model" => $interface->findById($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

}