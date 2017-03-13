<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

/**
 * Trait AdapterTestTrait
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
trait AdapterTestTrait
{
    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        if ($this->isAvailable() === false) {
            $this->markTestSkipped(sprintf('The test "%s" is not available.', get_class($this)));
        }
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
}
