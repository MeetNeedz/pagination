<?php
namespace MeetNeedz\Component\Paginator\Tests;

use MeetNeedz\Component\Paginator\Adapter\AdapterInterface;
use MeetNeedz\Component\Paginator\Adapter\NullAdapter;
use MeetNeedz\Component\Paginator\Exception\LogicException;
use MeetNeedz\Component\Paginator\Pagination;
use Prophecy\Argument;

/**
 * Class PaginationTest
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class PaginationTest extends \PHPUnit_Framework_TestCase
{
    public function testBaseGetters()
    {
        $adapter = new NullAdapter(42);
        $pagination = new Pagination($adapter);

        $this->assertEquals(1, $pagination->getCurrentPage());
        $this->assertEquals(5, $pagination->getTotalPages());
        $this->assertEquals(10, $pagination->getItemsPerPage());
        $this->assertEquals(42, $pagination->getTotalItems());
        $this->assertEquals(42, $pagination->count());
    }

    public function testPager()
    {
        $adapter = new NullAdapter(42);
        $pagination = new Pagination($adapter);
        $pagination->setCurrentPage(2);

        $this->assertTrue($pagination->hasNextPage());
        $this->assertEquals(3, $pagination->getNextPage());
        $this->assertTrue($pagination->hasPreviousPage());
        $this->assertEquals(1, $pagination->getPreviousPage());

        $pagination->setCurrentPage(1);
        $this->assertFalse($pagination->hasPreviousPage());

        $pagination->setCurrentPage(5);
        $this->assertFalse($pagination->hasNextPage());
    }

    public function testPagerInvalidPrevious()
    {
        $adapter = new NullAdapter(42);
        $pagination = new Pagination($adapter);
        $pagination->setCurrentPage(1);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('There is not previous page.');

        $pagination->getPreviousPage();
    }

    public function testPagerInvalidNext()
    {
        $adapter = new NullAdapter(42);
        $pagination = new Pagination($adapter);
        $pagination->setCurrentPage(5);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('There is not next page.');

        $pagination->getNextPage();
    }

    public function testIterators()
    {
        $iterator = $this->prophesize(\Iterator::class)->reveal();
        $iteratorAdapter = $this->prophesize(AdapterInterface::class)
            ->getSlice(0, 10)->willReturn($iterator)->getObjectProphecy()
            ->reveal();

        $pagination = new Pagination($iteratorAdapter);
        $this->assertSame($iterator, $pagination->getIterator());

        $iteratorAggregate = $this->prophesize(\IteratorAggregate::class)
            ->getIterator()->willReturn($iterator)->getObjectProphecy()
            ->reveal();
        $iteratorAggregateAdapter = $this->prophesize(AdapterInterface::class)
            ->getSlice(0, 10)->willReturn($iteratorAggregate)->getObjectProphecy()
            ->reveal();

        $pagination = new Pagination($iteratorAggregateAdapter);
        $this->assertSame($iterator, $pagination->getIterator());

        $arrayAdapter = new NullAdapter(0);
        $pagination = new Pagination($arrayAdapter);
        $this->assertInstanceOf(\ArrayIterator::class, $pagination->getIterator());
    }
}
