<?php

namespace app\src;

class Collection
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public static function make($items): Collection
    {
        return new static($items);
    }

    public function map($callback): Collection
    {
        return new static(array_map($callback, $this->items));
    }

    public function filter($callback): Collection
    {
        return new static(array_filter($this->items, $callback));
    }

    public function reduce($callback, $initial): Collection
    {
        return new static(array_reduce($this->items, $callback, $initial));
    }
}
