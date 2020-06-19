<?php
namespace Lotarbo\MetaTags\Objects;

use Lotarbo\MetaTags\Utils;

class Description
{
    protected $value;

    public function __construct(?string $value = null)
    {
        $this->setValue($value);
    }

    public function getDescription(): ?string
    {
        return $this->getValue();
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
}