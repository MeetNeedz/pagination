<?php
namespace MeetNeedz\Component\Paginator;

use MeetNeedz\Component\Paginator\Adapter\AdapterInterface;
use MeetNeedz\Component\Paginator\Exception\LogicException;

/**
 * Class Pagination
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class Pagination implements PaginationInterface
{
    /**
     * Contains the adapter.
     *
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * Contains the number of the current page.
     *
     * @var int
     */
    private $currentPage = 1;

    /**
     * Contains the number of items per page.
     *
     * @var int
     */
    private $itemsPerPage = 10;

    /**
     * Contains the page items.
     *
     * @var int
     */
    private $pageItems;

    /**
     * Constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @inheritDoc
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        $this->pageItems = null;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTotalPages()
    {
        return ceil($this->getTotalItems() / $this->getItemsPerPage());
    }

    /**
     * @inheritDoc
     */
    public function getTotalItems()
    {
        return $this->adapter->getTotalItems();
    }

    /**
     * @inheritDoc
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * @inheritDoc
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
        $this->pageItems = null;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPageItems()
    {
        if ($this->pageItems === null) {
            $this->pageItems = $this->adapter->getSlice(($this->getCurrentPage() - 1) * $this->getItemsPerPage(), $this->getItemsPerPage());
        }

        return $this->pageItems;
    }

    /**
     * @inheritDoc
     */
    public function hasNextPage()
    {
        return $this->currentPage < $this->getTotalPages();
    }

    /**
     * @inheritDoc
     */
    public function hasPreviousPage()
    {
        return $this->currentPage > 1;
    }

    /**
     * @inheritDoc
     */
    public function getNextPage()
    {
        if ($this->hasNextPage() === false) {
            throw new LogicException('There is not next page.');
        }

        return $this->currentPage + 1;
    }

    /**
     * @inheritDoc
     */
    public function getPreviousPage()
    {
        if ($this->hasPreviousPage() === false) {
            throw new LogicException('There is not previous page.');
        }

        return $this->currentPage - 1;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        $pageItems = $this->getPageItems();
        if ($pageItems instanceof \Iterator) {
            return $pageItems;
        }
        if ($pageItems instanceof \IteratorAggregate) {
            return $pageItems->getIterator();
        }

        return new \ArrayIterator($pageItems);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->getTotalItems();
    }
}
