<?php

namespace Kosci\Bundle\ProxyLCDBundle\Service;

use Kosci\Bundle\ProxyLCDBundle\Exception\Proxy;

class ProxyLCD implements ProxyLCDInterface
{
    /**
     * @var string
     */
    private $ip;

    /**
     * @var int
     */
    private $port;

    /**
     * @param string $ip
     * @param int    $port
     */
    public function __construct($ip, $port)
    {
        $this->ip = $ip;
        $this->port = $port;
    }

    /**
     * @param mixed $content
     *
     * @throws Proxy
     */
    public function stream($content)
    {
        if (!$this->ip) {
            return;
        }

        if (is_array($content)) {
            $content = '['.implode(',', $content).']';
        } elseif (is_object($content)) {
            $content = get_class($content);
        }

        try {
            $fp = fsockopen($this->ip, $this->port, $errno, $errstr, 10);
            fwrite($fp, $content);
            fclose($fp);
        } catch (\Exception $exception) {
            throw Proxy::conectionFailed($this->ip, $this->port, $exception->getMessage());
        }
    }
}
