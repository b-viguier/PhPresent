<?php

namespace PhPresent\Presentation;

interface Progress
{
    public function count(): int;

    public function advance(): int;
}
