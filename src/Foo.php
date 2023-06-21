<?php declare(strict_types=1);

namespace App;

class Foo
{
    public function __construct(readonly private Bar $bar)
    {

    }

    public function baz(string $test): string
    {
        return $this->bar->bar($test);
    }
}