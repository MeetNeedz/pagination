<?php

namespace MeetNeedz\Component\Paginator;

use MeetNeedz\Component\Paginator\Adapter\AdapterInterface;

/**
 * Interface PaginatorInterface.
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
interface PaginatorInterface
{
    /**
     * Paginates the adapter.
     *
     * @param AdapterInterface $adapter
     * @param array            $options
     *
     * @return PaginationInterface
     */
    public function paginate(AdapterInterface $adapter, array $options = []);
}
