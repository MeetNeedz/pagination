<?php
namespace MeetNeedz\Component\Paginator\Tests;

use MeetNeedz\Component\Paginator\Adapter\AdapterInterface;
use MeetNeedz\Component\Paginator\Adapter\NullAdapter;
use MeetNeedz\Component\Paginator\PaginationInterface;
use MeetNeedz\Component\Paginator\Paginator;

/**
 * Class PaginatorTest
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class PaginatorTest extends \PHPUnit_Framework_TestCase
{
    public function testPaginateReturnsPaginationInstance()
    {
        $paginator = new Paginator();
        $adapter = $this->prophesize(AdapterInterface::class)->reveal();
        $pagination = $paginator->paginate($adapter);

        $this->assertInstanceOf(PaginationInterface::class, $pagination);
    }

    public function testPaginateOptions()
    {
        $paginator = new Paginator();
        $adapter = new NullAdapter(42);
        $pagination = $paginator->paginate($adapter, [
            'current_page' => 2,
            'items_per_page' => 10
        ]);

        $this->assertEquals(42, $pagination->getTotalItems());
        $this->assertEquals(2, $pagination->getCurrentPage());
        $this->assertEquals(10, count($pagination->getPageItems()));

        $pagination = $paginator->paginate($adapter, [
            'current_page' => 5,
            'items_per_page' => 10
        ]);

        $this->assertEquals(2, count($pagination->getPageItems()));
    }
}
