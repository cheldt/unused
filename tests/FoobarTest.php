<?php declare(strict_types=1);

namespace App\Tests;

use App\Bar;
use App\Foo;
use PHPUnit\Framework\TestCase;

class FoobarTest extends TestCase
{
    public function testBaz(): void
    {
        $barMock = $this->createMock(Bar::class);

        $matcher = self::exactly(2);
        $barMock->expects($matcher)->method('bar')
            ->willReturnCallback(
                static function (string $test) use ($matcher): string {
                    match ($matcher->numberOfInvocations()) {
                        1 => self::assertEquals('test1', $test),
                        2 => self::assertEquals('test2', $test),
                        default => new \LogicException()
                    };

                    return $test;
                }
            );


        $sut = new Foo($barMock);

        $sut->baz('test1');
        $sut->baz('test2');
    }
}