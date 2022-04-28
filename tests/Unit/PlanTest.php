<?php

namespace Tests\Unit;

use App\Models\Plan;
use PHPUnit\Framework\TestCase;

class PlanTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function check_if_Plan_columns_is_correct()
    {
        $plan = new Plan;
        $expected = [
            'name',
            'time'
        ];
        $actual = $plan->getFillable();
        $this->assertEquals($expected, $actual);
    }
}
