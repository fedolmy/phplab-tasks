<?php

namespace src\oop\Commands;

class ExpCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != count($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        }

        return $args[0] ** $args[1];
    }
}
