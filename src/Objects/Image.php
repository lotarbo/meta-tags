<?php


namespace Lotarbo\MetaTags\Objects;


class Image
{
    protected $src;
    protected $width;
    protected $height;

    public function __construct($src = null, $width = null, $height = null)
    {
        $this->src = $src;
        $this->width = $width;
        $this->height = $height;
    }


    public function getSrc()
    {
        return $this->src;
    }


    public function setSrc(?string $src)
    {
        $this->src = $src;
        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth(?int $width)
    {
        $this->width = $width;
        return $this;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight(?int $height)
    {
        $this->height = $height;
        return $this;
    }


}