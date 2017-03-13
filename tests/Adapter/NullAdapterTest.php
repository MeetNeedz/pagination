<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

use MeetNeedz\Component\Paginator\Adapter\AdapterInterface;
use MeetNeedz\Component\Paginator\Adapter\NullAdapter;

/**
 * Class NullAdapterTest
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class NullAdapterTest extends AbstractAdapterTest
{
    /**
     * @inheritDoc
     */
    protected function getAdapter()
    {
        return new NullAdapter(42);
    }

    /**
     * @inheritDoc
     */
    protected function isAvailable()
    {
        return true;
    }
}
