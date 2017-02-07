<?php

namespace Hone\Bundle\ProxyLCDBundle\Service;

interface ProxyLCDInterface
{
    /**
     * @param mixed $content
     */
    public function stream($content);
}
