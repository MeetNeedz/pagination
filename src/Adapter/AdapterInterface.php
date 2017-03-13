<?php

namespace MeetNeedz\Component\Paginator\Adapter;

/**
 * Interface AdapterInterface.
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
interface AdapterInterface
{
    /**
     * Gets a slice.
     *
     * @param integer $offset
     * @param integer $length
     *
     * @return array|\Iterator|\IteratorAggregate
     */
    public function getSlice($offset, $length);

    /**
     * Gets the total of items.
     *
     * @return int
     */
    public function getTotalItems();
}
