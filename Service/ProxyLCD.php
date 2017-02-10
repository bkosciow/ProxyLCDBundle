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
     * @var Transformer
     */
    private $transformer;

    /**
     * @param Transformer $transformer
     * @param string      $ip
     * @param int         $port
     */
    public function __construct(Transformer $transformer, $ip, $port)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->transformer = $transformer;
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

        $content = $this->transformer->transform($content);
        try {
            $fp = fsockopen($this->ip, $this->port, $errno, $errstr, 10);
            fwrite($fp, $content);
            fclose($fp);
        } catch (\Exception $exception) {
            throw Proxy::conectionFailed($this->ip, $this->port, $exception->getMessage());
        }
    }
}
