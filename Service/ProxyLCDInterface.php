<?php

namespace Kosci\Bundle\ProxyLCDBundle\Service;

interface ProxyLCDInterface
{
    /**
     * @param mixed $content
     */
    public function stream($content);
}
