<?php


namespace Lotarbo\MetaTags;


/**
 * @method Tag name(string $string)
 * @method Tag property(string $string)
 * @method Tag content(string $string)
 */
class Tag
{
    protected $tag;
    protected $value;
    protected $attributes = [];

    public function __construct(string $tag, string $value = null, array $attributes = [])
    {
        $this->tag = $tag;
        $this->value($value);
        $this->setAttributes($attributes);
    }

    public static function make(string $tag, string $value = null, array $attributes = []): Tag
    {
        return new static(...func_get_args());
    }

    public static function meta(array $attributes = []): Tag
    {
        return new static('meta', null, $attributes);
    }

    public function render(): string
    {
        $attributes = [];
        foreach ($this->attributes as $attribute => $value) {
            $attributes[] = sprintf('%s="%s"', $attribute, $value);
        }

        $open = $this->value
            ? sprintf('<%s %s>', $this->tag, implode(' ', $attributes))
            : sprintf('<%s %s', $this->tag, implode(' ', $attributes));
        $close = $this->value ? sprintf('</%s> ', $this->tag) : '>';

        return $open.$this->value.$close;
    }

    public function value($value): Tag
    {
        $this->value = Utils::escape($value);
        return $this;
    }

    public function setAttributes(array $attributes): Tag
    {
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }

        return $this;
    }

    public function setAttribute(string $attribute, $value): Tag
    {
        $this->attributes[$attribute] = Utils::escape($value);
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __call($method, $parameters)
    {
        return $this->setAttribute($method, $parameters[0]);
    }

    public function __toString()
    {
        return $this->render();
    }
}