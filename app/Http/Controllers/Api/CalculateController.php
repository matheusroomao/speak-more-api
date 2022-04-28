<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateRequest;
use App\Repository\Contract\CalculateInterface;

class CalculateController extends Controller
{
    public function calculate(CalculateRequest $request, CalculateInterface $interface)
    {
        return response()->json(["model" => $interface->calculate($request)]);
    }

}