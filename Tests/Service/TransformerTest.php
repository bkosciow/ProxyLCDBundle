<?php

namespace Kosci\Bundle\ProxyLCDBundle\Tests\Service;

use Kosci\Bundle\ProxyLCDBundle\Service\Transformer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TransformerTest extends KernelTestCase
{
    /**
     * @var Transformer
     */
    private $transformer;

    public function setUp()
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();

        $this->transformer = $container->get('kosci.proxy_lcd.service.transformer');
    }

    public function testStringTransformation()
    {
        // Given
        $input = 'This is string';

        // When
        $output = $this->transformer->transform($input);

        // Then
        $this->assertEquals($input, $output);
    }

    public function testArrayTransformation()
    {
        // Given
        $input = ['one', 'two', 'eleven'];

        // When
        $output = $this->transformer->transform($input);

        // Then
        $this->assertEquals('[one,two,eleven]', $output);
    }

    public function testDictionaryTransformation()
    {
        // Given
        $input = [
            'one' => 'zombie',
            'two' => 'zombies',
            'eleven' => 'abnominations',
        ];

        // When
        $output = $this->transformer->transform($input);

        // Then
        $this->assertEquals('[one:zombie,two:zombies,eleven:abnominations]', $output);
    }

    public function testMultidimensionalTransformation()
    {
        // Given
        $input = [
            'one' => [
                'one', 'two',
            ],
            'two' => [
                'zombies' => 'no',
                'humans' => 'yes',
            ],
            'eleven' => 'abnominations',
        ];

        // When
        $output = $this->transformer->transform($input);

        // Then
        $this->assertEquals('[one:[one,two],two:[zombies:no,humans:yes],eleven:abnominations]', $output);
    }

    public function testObjectTransformation()
    {
        // Given
       $input = new ItemSimple();
        $input->id = 2;

        // When
        $output = $this->transformer->transform($input);

        // Then
        $this->assertEquals('{ItemSimple:2}', $output);
    }

    public function testObjectWithNameTransformation()
    {
        // Given
        $input = new ItemWithName(12);

        // When
        $output = $this->transformer->transform($input);

        // Then
        $this->assertEquals('{ItemWithName:12:name}', $output);
    }
}
