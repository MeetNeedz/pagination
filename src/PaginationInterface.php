<?php

namespace MeetNeedz\Component\Paginator;

/**
 * Interface PaginationInterface.
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
interface PaginationInterface extends \IteratorAggregate, \Countable
{
    /**
     * Gets the number of the current page
     *
     * @return int
     */
    public function getCurrentPage();

    /**
     * Sets the current page.
     *
     * @param int $currentPage
     *
     * @return $this
     */
    public function setCurrentPage($currentPage);

    /**
     * Gets the number of total pages
     *
     * @return int
     */
    public function getTotalPages();

    /**
     * Gets the number of total items
     *
     * @return int
     */
    public function getTotalItems();

    /**
     * Gets the number of items per page
     *
     * @return int
     */
    public function getItemsPerPage();

    /**
     * Sets the number of items per page
     *
     * @param int $itemsPerPage
     *
     * @return $this
     */
    public function setItemsPerPage($itemsPerPage);

    /**
     * Gets the page items
     *
     * @return array
     */
    public function getPageItems();

    /**
     * Checks if there if a next page
     *
     * @return bool
     */
    public function hasNextPage();

    /**
     * Gets the number of the next page.
     *
     * @return int
     */
    public function getNextPage();

    /**
     * Checks if there is a previous page
     *
     * @return bool
     */
    public function hasPreviousPage();

    /**
     * Gets the number of the previous page
     *
     * @return int
     */
    public function getPreviousPage();
}
