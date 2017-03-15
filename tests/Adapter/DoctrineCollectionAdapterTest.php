<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

use Doctrine\Common\Collections\ArrayCollection;
use MeetNeedz\Component\Paginator\Adapter\DoctrineCollectionAdapter;

/**
 * Class DoctrineCollectionAdapterTest
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class DoctrineCollectionAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        if (interface_exists('Doctrine\Common\Collections\Collection') && class_exists('Doctrine\Common\Collections\ArrayCollection') === false) {
            $this->markTestSkipped(sprintf('The test "Doctrine Collection" is not available.', get_class($this)));
        }
    }

    /**
     * @inheritDoc
     */
    public function getAdapter()
    {
        $data = [];
        for ($i = 0; $i < 42; $i++) {
            $data[] = 'collection-item-' . ($i + 1);
        }
        $collection = new ArrayCollection($data);
        return new DoctrineCollectionAdapter($collection);
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
