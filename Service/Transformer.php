<?php

namespace Kosci\Bundle\ProxyLCDBundle\Service;

use Symfony\Component\PropertyAccess\PropertyAccess;

class Transformer
{
    /**
     * @param mixed $object
     *
     * @return string
     */
    public function transform($object)
    {
        if (is_array($object)) {
            return $this->transformFromArray($object);
        }
        if (is_object($object)) {
            return $this->transformFromObject($object);
        }

        return $object;
    }

    /**
     * @param array $object
     *
     * @return string
     */
    private function transformFromArray($object)
    {
        if ($this->isAssoc($object)) {
            $array = [];
            foreach ($object as $k => $v) {
                $array[] = $k.':'.$this->transform($v);
            }

            return '['.implode(',', $array).']';
        } else {
            $array = [];
            foreach ($object as $v) {
                $array[] = $this->transform($v);
            }

            return '['.implode(',', $array).']';
        }
    }

    /**
     * @param object $object
     *
     * @return string
     */
    private function transformFromObject($object)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        $result = (new \ReflectionClass($object))->getShortName();
        if ($accessor->isReadable($object, 'id')) {
            $result .= ':'.$accessor->getValue($object, 'id');
        }
        if (method_exists($object, '__toString')) {
            $result .= ':'.$object;
        }

        return '{'.$result.'}';
    }

    /**
     * @param array $arr
     *
     * @return bool
     */
    private function isAssoc($arr)
    {
        if (array() === $arr) {
            return false;
        }

        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
