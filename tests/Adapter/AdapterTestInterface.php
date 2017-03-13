<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

use MeetNeedz\Component\Paginator\Adapter\AdapterInterface;

/**
 * Interface AdapterTestInterface
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
interface AdapterTestInterface
{
    /**
     * Gets the adapter to test
     *
     * @return AdapterInterface
     */
    public function getAdapter();

    /**
     * Checks if the test is available
     *
     * @return bool
     */
    public function isAvailable();
}
