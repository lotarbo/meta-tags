<?php

namespace Lotarbo\MetaTags\Traits;


use Lotarbo\MetaTags\Objects\Description;

trait DescriptionTrait
{
    /**
     * @var Description
     */
    protected $description;

    public function setDescription(?string $description): self
    {
        $this->description->setValue($description);
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description->getDescription();
    }

    public function setDescriptionLength(?int $length): self
    {
        $this->description->setLength($length);
        return $this;
    }
}