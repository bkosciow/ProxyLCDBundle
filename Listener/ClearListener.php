<?php

namespace Kosci\Bundle\ProxyLCDBundle\Listener;

use Kosci\Bundle\ProxyLCDBundle\Service\ProxyLCDInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ClearListener
{
    /**
     * @var bool
     */
    private $clearOnRequest;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @param $enabled
     * @param $clearOnRequest
     * @param $requestLength
     * @param ProxyLCDInterface $proxyLCD
     */
    public function __construct(
        $enabled,
        $clearOnRequest,
        $requestLength,
        ProxyLCDInterface $proxyLCD
    )
    {
        $this->enabled = $enabled;
        $this->proxyLCD = $proxyLCD;
        $this->clearOnRequest = $clearOnRequest;
        $this->requestLength = $requestLength;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest() || !$this->enabled || !$this->clearOnRequest) {
            return;
        }
        $session = $event->getRequest()->getSession();
        $current = $session->get('proxylcd.time', 0);
        if ($current + $this->requestLength < time()) {
            $this->proxyLCD->clearDisplays();
        }
        $session->set('proxylcd.time', time());
    }
}