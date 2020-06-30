<?php

namespace Lotarbo\MetaTags\Objects;

use Lotarbo\MetaTags\Utils;

class Description
{
    protected $value;
    protected $length = 160;

    public function __construct(?string $value = null)
    {
        $this->setValue($value);
    }

    public function getDescription(): ?string
    {
        $description = $this->getValue();
        return Utils::cut($description, $this->length);
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = Utils::escape($value);
        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): self
    {
        $this->length = $length;
        return $this;
    }
}