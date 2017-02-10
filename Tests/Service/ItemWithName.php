<?php

namespace Kosci\Bundle\ProxyLCDBundle\Tests\Service;

class ItemWithName
{
    private $id;

    private $content;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return 'name';
    }
}
