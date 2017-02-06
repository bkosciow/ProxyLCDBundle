<?php

namespace Hone\ProxyLCDBundle\Service;

interface ProxyLCDInterface
{
    /**
     * @param mixed $content
     */
    public function stream($content);
}
