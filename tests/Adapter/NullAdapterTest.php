<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

use MeetNeedz\Component\Paginator\Adapter\NullAdapter;

/**
 * Class NullAdapterTest
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class NullAdapterTest extends \PHPUnit_Framework_TestCase implements AdapterTestInterface
{
    use AdapterTestTrait;

    /**
     * @inheritDoc
     */
    public function getAdapter()
    {
        return new NullAdapter(42);
    }

    /**
     * @inheritDoc
     */
    public function isAvailable()
    {
        return true;
    }
}
