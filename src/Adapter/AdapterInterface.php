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
     * @param int $offset
     * @param int|null $length
     * @param bool $preserveKeys
     *
     * @return array|\Iterator|\IteratorAggregate
     */
    public function getSlice($offset, $length = null, $preserveKeys = false);

    /**
     * Gets the total of items.
     *
     * @return int
     */
    public function getTotalItems();
}
