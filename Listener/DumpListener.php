<?php

namespace Hone\Bundle\ProxyLCDBundle\Listener;

use Hone\Bundle\ProxyLCDBundle\Service\ProxyLCDInterface;
use Symfony\Component\VarDumper\Cloner\ClonerInterface;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use Symfony\Component\VarDumper\VarDumper;

class DumpListener
{
    /**
     * @var ClonerInterface
     */
    private $cloner;

    /**
     * @var DataDumperInterface
     */
    private $dumper;

    /**
     * @var ProxyLCDInterface
     */
    private $proxyLCD;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @param $enabled
     * @param ProxyLCDInterface   $proxyLCD
     * @param DataDumperInterface $dumper
     * @param ClonerInterface     $cloner
     */
    public function __construct(
        $enabled,
        ProxyLCDInterface $proxyLCD,
        DataDumperInterface $dumper,
        ClonerInterface $cloner
    ) {
        $this->cloner = $cloner;
        $this->dumper = $dumper;
        $this->proxyLCD = $proxyLCD;
        $this->enabled = $enabled;
    }

    public function onKernelRequest()
    {
        if (!$this->enabled) {
            return;
        }

        $dumper = $this->dumper;
        $cloner = $this->cloner;
        $proxyLCD = $this->proxyLCD;

        VarDumper::setHandler(function ($var) use ($cloner, $dumper, $proxyLCD) {
            $proxyLCD->stream($var);
            $dumper->dump($cloner->cloneVar($var));
        });
    }
}
