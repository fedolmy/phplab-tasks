<?php

namespace src\oop\Commands;

class DivCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != count($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        } elseif (0 == $args[1]) {
            throw new \InvalidArgumentException('Can\'t divide by zero');
        }

        return $args[0] / $args[1];
    }
}
