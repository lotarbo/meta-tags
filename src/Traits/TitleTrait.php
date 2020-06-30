<?php

namespace Lotarbo\MetaTags\Traits;

use Lotarbo\MetaTags\Objects\Title;

trait TitleTrait
{
    /**
     * @var Title
     */
    protected $title;

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

    public function setTitleLength(?int $length): self
    {
        $this->title->setLength($length);
        return $this;
    }

    public function setTitleOptions($options)
    {
        if (isset($options['title']['default'])) {
            $this->title->setValue($options['title']['default']);
        }

        if (isset($options['title']['prefix'])) {
            $this->title->setPrefix($options['title']['prefix']);
        }

        if (isset($options['title']['prefix_separator'])) {
            $this->title->setPrefixSeparator($options['title']['prefix_separator']);
        }

        if (isset($options['title']['length'])) {
            $this->title->setLength($options['title']['length']);
        }
    }
}