<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

use MeetNeedz\Component\Paginator\Adapter\DoctrinePaginatorAdapter;
use MeetNeedz\Component\Paginator\Tests\Adapter\DoctrinePaginator\MyItem;
use MeetNeedz\Component\Paginator\Tests\Adapter\DoctrinePaginator\MyList;
use MeetNeedz\TestTools\DoctrineTestCase;

/**
 * Class DoctrinePaginatorAdapterTest
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class DoctrinePaginatorAdapterTest extends DoctrineTestCase
{
    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        if (class_exists('Doctrine\ORM\Tools\Pagination\Paginator') === false) {
            $this->markTestSkipped(sprintf('The test "Doctrine Paginator" is not available.', get_class($this)));
        }
    }

    /**
     * @inheritDoc
     */
    protected function getProxySettings()
    {
        return [__DIR__ . '/DoctrinePaginator/_files', 'MeetNeedz\Component\Paginator\Tests\Adapter\DoctrinePaginator\Proxies'];
    }

    /**
     * @inheritDoc
     */
    protected function getEntities()
    {
        $entities = [];

        for ($i = 0; $i < 5; $i++) {
            $list = new MyList();
            $list->name = sprintf('list-%d', $i + 1);
            for ($j = 0; $j < $i; $j++) {
                $item = new MyItem();
                $item->list = $list;
                $item->value = sprintf('list-%d-item-%d', $i + 1, $j + 1);
                $list->items[] = $item;
                $entities[] = $item;
            }
            $entities[] = $list;
        }

        return $entities;
    }

    public function testSlices()
    {
        $adapter = new DoctrinePaginatorAdapter($this->entityManager->createQuery('SELECT l FROM MeetNeedz\Component\Paginator\Tests\Adapter\DoctrinePaginator\MyList l'));
        $slice = $adapter->getSlice(0, 0);
        $this->assertEquals(0, count($slice));

        $slice = $adapter->getSlice(0, 5);
        $this->assertEquals(5, count($slice));

        $slice = $adapter->getSlice(0, 10);
        $this->assertEquals(5, count($slice));

        $slice = $adapter->getSlice(1, 1);
        $this->assertEquals(1, count($slice));

        $slice = $adapter->getSlice(10, 20);
        $this->assertEquals(0, count($slice));
    }

    public function testTotalItems()
    {
        $adapter = new DoctrinePaginatorAdapter($this->entityManager->createQuery('SELECT l FROM MeetNeedz\Component\Paginator\Tests\Adapter\DoctrinePaginator\MyList l'));
        $this->assertEquals(5, $adapter->getTotalItems());
    }
}