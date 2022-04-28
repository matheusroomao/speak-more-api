<?php

namespace Tests\Unit;

use App\Models\Code;
use PHPUnit\Framework\TestCase;

class CodeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function check_if_code_columns_is_correct()
    {
        $code = new Code;
        $expected = [
            'code'
        ];
        $actual = $code->getFillable();
        $this->assertEquals($expected, $actual);
    }
}
