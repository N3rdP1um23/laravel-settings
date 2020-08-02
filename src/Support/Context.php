<?php

namespace Rawilk\Settings\Support;

use Countable;
use OutOfBoundsException;

class Context implements Countable
{
    protected array $arguments = [];

    public function __construct(array $arguments = [])
    {
        foreach ($arguments as $name => $value) {
            $this->set($name, $value);
        }
    }

    public function get(string $name)
    {
        if (! $this->has($name)) {
            throw new OutOfBoundsException(
                sprintf('"%s" is not part of the context.', $name)
            );
        }

        return $this->arguments[$name];
    }

    public function has(string $name): bool
    {
        return isset($this->arguments[$name]);
    }

    public function remove(string $name): self
    {
        unset($this->arguments[$name]);

        return $this;
    }

    public function set(string $name, $value): self
    {
        $this->arguments[$name] = $value;

        return $this;
    }

    public function count(): int
    {
        return count($this->arguments);
    }
}
