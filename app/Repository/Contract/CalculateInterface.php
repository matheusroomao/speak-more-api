<?php 
namespace App\Repository\Contract;
use Illuminate\Http\Request;

interface CalculateInterface{
    public function calculate(Request $request);
    public function getMessage();
}