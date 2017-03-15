<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

use MeetNeedz\Component\Paginator\Adapter\NullAdapter;

/**
 * Class NullAdapterTest
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class NullAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testSlices()
    {
        $adapter = new NullAdapter(42);
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
        $adapter = new NullAdapter(42);
        $this->assertEquals(42, $adapter->getTotalItems());
    }
}
