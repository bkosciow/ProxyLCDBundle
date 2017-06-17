<?php

namespace Kosci\Bundle\ProxyLCDBundle\Service;

interface ProxyLCDInterface
{
    /**
     * Transform $content into $string
     *
     * @param mixed $content
     */
    public function stream($content);

    /**
     * Sends command to clear displays
     *
     * @return mixed
     */
    public function clearDisplays();
}
