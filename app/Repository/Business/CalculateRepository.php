<?php

namespace App\Repository\Business;

use App\Models\Plan;
use App\Repository\Contract\CalculateInterface;
use Illuminate\Http\Request;

class CalculateRepository implements CalculateInterface
{
    public function calculate(Request $request)
    {
        $plan = Plan::find($request->plan_id);
        if (($request->origin == 1) && ($request->destiny == 2)) {
            $sum1 = (($request->time - $plan->time) * 1.90) * 1.10;
            $sum2 = $request->time * 1.90;
            if ($sum1 <= 0) {
                $sum1 = 0;
            }
            $model = ["With_Speak_more" => number_format($sum1, 2, ",", "."), "Without_Speak_more" => number_format($sum2, 2, ",", ".")];
            return $model;
        }
        else if (($request->origin == 2) && ($request->destiny == 1)) {
            $sum1 = (($request->time - $plan->time) * 2.90) * 1.10;
            $sum2 = $request->time * 2.90;
            if ($sum1 <= 0) {
                $sum1 = 0;
            }
            $model = ["With_Speak_more" => number_format($sum1, 2, ",", "."), "Without_Speak_more" => number_format($sum2, 2, ",", ".")];
            return $model;
        }
        else if (($request->origin == 1) && ($request->destiny == 3)) {
            $sum1 = (($request->time - $plan->time) * 1.70) * 1.10;
            $sum2 = $request->time * 1.70;
            if ($sum1 <= 0) {
                $sum1 = 0;
            }
            $model = ["With_Speak_more" => number_format($sum1, 2, ",", "."), "Without_Speak_more" => number_format($sum2, 2, ",", ".")];
            return $model;
        }
        else if (($request->origin == 3) && ($request->destiny == 1)) {
            $sum1 = (($request->time - $plan->time) * 2.70) * 1.10;
            $sum2 = $request->time * 2.70;
            if ($sum1 <= 0) {
                $sum1 = 0;
            }
            $model = ["With_Speak_more" => number_format($sum1, 2, ",", "."), "Without_Speak_more" => number_format($sum2, 2, ",", ".")];
            return $model;
        }
        else if (($request->origin == 1) && ($request->destiny == 4)) {
            $sum1 = (($request->time - $plan->time) * 0.90) * 1.10;
            $sum2 = $request->time * 0.90;
            if ($sum1 <= 0) {
                $sum1 = 0;
            }
            $model = ["With_Speak_more" => number_format($sum1, 2, ",", "."), "Without_Speak_more" => number_format($sum2, 2, ",", ".")];
            return $model;
        }
        else if (($request->origin == 4) && ($request->destiny == 1)) {
            $sum1 = (($request->time - $plan->time) * 1.90) * 1.10;
            $sum2 = $request->time * 1.90;
            if ($sum1 <= 0) {
                $sum1 = 0;
            }
            $model = ["With_Speak_more" => number_format($sum1, 2, ",", "."), "Without_Speak_more" => number_format($sum2, 2, ",", ".")];
            return $model;
        }
        else
        {
            $model = ["Impossível para essa região"];
            return $model;
        }
    }
    public function getMessage()
    {
        return $this->message;
    }
    
}
