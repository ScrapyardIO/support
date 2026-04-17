<?php

namespace ScrapyardIO\Support\DTO;

class ByteRegister
{
    public int $byte;

    public function __construct(int $b)
    {
        $this->byte = $b & 0xFF;
    }

    public function read(int $position): int
    {
        if (($position < 0) || ($position > 7)) {
            return -1;
        }

        return ($this->byte >> $position) & 1;
    }

    public function byte(int $position, bool $on = true): int
    {
        if (($position < 0) || ($position > 7)) {
            return -1;
        }

        $result = $this->byte;

        if ($on) {
            $mask = 1 << $position;
            $result |= $mask;
        } else {
            $bit_mask = 1 << $position;
            $result &= ~$bit_mask;
        }

        return $result & 0xFF;
    }

    public function update(int $position, bool $on = true): static
    {
        $newVal = $this->byte($position, $on);

        if ($newVal < 0) {
            return new static($this->byte);
        }

        return new static($newVal);
    }

    public function toBools(): array
    {
        $bools = [];

        for ($i = 7; $i >= 0; $i--) {
            $bools[$i] = (($this->byte >> $i) & 1) === 1;
        }

        return $bools;
    }
}
