<?php

namespace Tgu\Mityutyuk\PhpUnit\Blog\Commands;

use PHPUnit\Framework\TestCase;
use Tgu\Mityutyuk\Blog\Commands\Arguments;
use Tgu\Mityutyuk\Exceptions\Argumentsexception;

class ArgumentsTest extends TestCase
{
    /**
     * @throws Argumentsexception
     */
    public function testItReturnsArgumentsByName():void
    {
        $arguments = new Arguments(['key' => 'value']);
        $value = $arguments->get('key');
        $this->assertEquals( 'value', $value);
    }

    /**
     * @throws Argumentsexception
     */
    public function testItReturnsValueAsString():void
    {
        $arguments = new Arguments(['key' => 555]);
        $value = $arguments->get('key');
        $this->assertEquals( '555', $value);
    }

    public function testItThrowAnExceptionWhenArgumentsAbsent():void
    {
        $arguments = new Arguments([]);
        $this->expectException(Argumentsexception::class);
        $this->expectExceptionMessage('No such argument: key');
        $arguments->get('key');

    }

}