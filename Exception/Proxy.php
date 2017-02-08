<?php

namespace Hone\Bundle\ProxyLCDBundle\Exception;

class Proxy extends \Exception
{
    /**
     * @param $ip
     * @param $port
     * @param $reason
     *
     * @return Proxy
     */
    public static function conectionFailed($ip, $port, $reason)
    {
        return new self(sprintf('Connection to %s:%s failed! %s', $ip, $port, $reason));
    }
}
