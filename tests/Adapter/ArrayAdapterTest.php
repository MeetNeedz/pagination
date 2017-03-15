<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

use MeetNeedz\Component\Paginator\Adapter\ArrayAdapter;

/**
 * Class ArrayAdapterTest
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class ArrayAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @inheritDoc
     */
    public function getAdapter()
    {
        $data = [];
        for ($i = 0; $i < 42; $i++) {
            $data[] = 'array-item-' . ($i + 1);
        }
        return new ArrayAdapter($data);
    }

    public function testSlices()
    {
        $adapter = $this->getAdapter();
        $slice = $adapter->getSlice(0, 0);
        $this->assertEquals(0, count($slice));

        $slice = $adapter->getSlice(0, 42);
        $this->assertEquals(42, count($slice));

        $slice = $adapter->getSlice(0, 50);
        $this->assertEquals(42, count($slice));

        $slice = $adapter->getSlice(40, 50);
        $this->assertEquals(2, count($slice));

        $slice = $adapter->getSlice(45, 50);
        $this->assertEquals(0, count($slice));
    }

    public function testTotalItems()
    {
        $adapter = $this->getAdapter();
        $this->assertEquals(42, $adapter->getTotalItems());
    }

    public function testLastItems()
    {
        $adapter = $this->getAdapter();
        $lastItems = $adapter->getSlice(37);

        $this->assertCount(5, $lastItems);
        $this->assertEquals('array-item-38', $lastItems[0]);
        $this->assertEquals('array-item-39', $lastItems[1]);
        $this->assertEquals('array-item-40', $lastItems[2]);
        $this->assertEquals('array-item-41', $lastItems[3]);
        $this->assertEquals('array-item-42', $lastItems[4]);
    }

    public function testLastItemsFromEnd()
    {
        $adapter = $this->getAdapter();
        $lastItems = $adapter->getSlice(-5);

        $this->assertCount(5, $lastItems);
        $this->assertEquals('array-item-38', $lastItems[0]);
        $this->assertEquals('array-item-39', $lastItems[1]);
        $this->assertEquals('array-item-40', $lastItems[2]);
        $this->assertEquals('array-item-41', $lastItems[3]);
        $this->assertEquals('array-item-42', $lastItems[4]);
    }
}
