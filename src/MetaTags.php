<?php

namespace Lotarbo\MetaTags;

use Lotarbo\MetaTags\Objects\Description;
use Lotarbo\MetaTags\Objects\Image;
use Lotarbo\MetaTags\Objects\Title;

class MetaTags
{
    protected $title;
    protected $description;
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
        if (isset($options['title']['default'])) {
            $this->setTitle($options['title']['default']);
        }

        if (isset($options['title']['prefix'])) {
            $this->setTitlePrefix($options['title']['prefix']);
        }

        if (isset($options['title']['prefix_separator'])) {
            $this->setTitlePrefixSeparator($options['title']['prefix_separator']);
        }

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

    public function setTitle($title): self
    {
        $this->title->setValue($title);
        return $this;
    }

    public function setTitlePrefix($titlePrefix): self
    {
        $this->title->setPrefix($titlePrefix);
        return $this;
    }

    public function setTitlePrefixSeparator($titlePrefixSeparator): self
    {
        $this->title->setPrefixSeparator($titlePrefixSeparator);
        return $this;
    }

    public function setTitlePostfix($titlePostfix): self
    {
        $this->title->setPostfix($titlePostfix);
        return $this;
    }

    public function setTitlePostfixSeparator($titlePostfixSeparator): self
    {
        $this->title->setPostfixSeparator($titlePostfixSeparator);
        return $this;
    }

    public function description($description): self
    {
        return $this->setDescription($description);
    }

    public function setDescription($description): self
    {
        $this->description->setValue($description);
        return $this;
    }

    public function getDescription()
    {
        return $this->description->getDescription();
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