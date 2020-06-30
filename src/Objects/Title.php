<?php

namespace Lotarbo\MetaTags\Objects;

use Lotarbo\MetaTags\Utils;

class Title
{
    protected $value;
    protected $length = 160;
    protected $prefix;
    protected $prefixSeparator;
    protected $postfix;
    protected $postfixSeparator;

    public function __construct(?string $value = null, ?string $prefix = null, ?string $prefixSeparator = ' | ')
    {
        $this->setValue($value);
    }

    public function getTitle(): string
    {
        return $this->buildTitle();
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

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(?string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function getPrefixSeparator(): ?string
    {
        return $this->prefixSeparator;
    }

    public function setPrefixSeparator(?string $prefixSeparator): self
    {
        $this->prefixSeparator = $prefixSeparator;
        return $this;
    }

    public function getPostfix(): ?string
    {
        return $this->postfix;
    }

    public function setPostfix(?string $postfix): self
    {
        $this->postfix = $postfix;
        return $this;
    }

    public function getPostfixSeparator(): ?string
    {
        return $this->postfixSeparator;
    }

    public function setPostfixSeparator(?string $postfixSeparator): self
    {
        $this->postfixSeparator = $postfixSeparator;
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

    protected function buildTitle()
    {
        $title = $this->value;
        if ($this->prefix) {
            $title = sprintf('%s%s%s', $this->prefix, $this->prefixSeparator, $title);
        }
        if ($this->postfix) {
            $title = sprintf('%s%s%s', $title, $this->postfixSeparator, $this->postfix);
        }

        $title = Utils::cut($title, $this->length);

        return $title;
    }
}