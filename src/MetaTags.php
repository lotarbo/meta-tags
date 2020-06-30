<?php

namespace Lotarbo\MetaTags;

use Lotarbo\MetaTags\Objects\Description;
use Lotarbo\MetaTags\Objects\Image;
use Lotarbo\MetaTags\Objects\Title;
use Lotarbo\MetaTags\Traits\DescriptionTrait;
use Lotarbo\MetaTags\Traits\TitleTrait;

class MetaTags
{
    use TitleTrait, DescriptionTrait;

    protected $url;
    protected $image;
    protected $options = [];

    public function __construct($options)
    {
        $this->title = new Title();
        $this->description = new Description();
        $this->image = new Image();
        $this->setOptions($options);
    }

    public function setOptions($options): self
    {
        $this->options = array_merge($this->options, $options);

        $this->setTitleOptions($options);

        if (isset($options['image']['src'])) {
            $this->image(
                $options['image']['src'],
                $options['image']['width'] ?? null,
                $options['image']['height'] ?? null
            );
        }

        return $this;
    }

    public function title($title): self
    {
        return $this->setTitle($title);
    }

    public function description($description): self
    {
        return $this->setDescription($description);
    }


    public function url($url): self
    {
        $this->url = $url;
        return $this;
    }

    public function image($src, $width = null, $height = null): self
    {
        $this->image->setSrc($src)->setWidth($width)->setHeight($height);

        return $this;
    }

    public function render(): string
    {
        $tags = [
            Tag::make('title', $this->title->getTitle()),
            Tag::meta()->name('description')->content($this->getDescription()),
            $this->facebook(),
        ];

        return implode("\n\t", $tags);
    }

    public function facebook(): string
    {
        $tags = [
            Tag::meta()->property('og:type')->content('website'),
            Tag::meta()->property('og:title')->content($this->title->getTitle()),
            Tag::meta()->property('og:description')->content($this->getDescription()),
            Tag::meta()->property('og:url')->content($this->url),
        ];

        if ($this->image->getSrc()) {
            $tags[] = Tag::meta()->property('og:image')->content($this->image->getSrc());
            if ($this->image->getWidth()) {
                $tags[] = Tag::meta()->property('og:image:width')->content($this->image->getWidth());
            }
            if ($this->image->getHeight()) {
                $tags[] = Tag::meta()->property('og:image:height')->content($this->image->getHeight());
            }
        }

        return implode("\n\t", $tags);
    }
}