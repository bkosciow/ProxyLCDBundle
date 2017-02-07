<?php

namespace Hone\Bundle\ProxyLCDBundle\Service;

class ProxyLCD implements ProxyLCDInterface
{
    private $ip;
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
     */
    public function stream($content)
    {
        if (is_array($content)) {
            $content = '['.implode(',', $content).']';
        } elseif (is_object($content)) {
            $content = get_class($content);
        }

        $fp = fsockopen($this->ip, $this->port, $errno, $errstr, 30);
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            fwrite($fp, $content);
            fclose($fp);
        }
    }
}
