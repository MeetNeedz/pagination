<?php
namespace MeetNeedz\Component\Paginator\Adapter;

/**
 * Class NullAdapter
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class NullAdapter implements AdapterInterface
{
    /**
     * Contains the number of total items.
     *
     * @var int
     */
    private $totalItems;

    /**
     * Constructor.
     *
     * @param int $totalItems
     */
    public function __construct($totalItems = 0)
    {
        $this->totalItems = $totalItems;
    }

    /**
     * @inheritDoc
     */
    public function getSlice($offset, $length)
    {
        if ($this->totalItems < $offset) {
            return [];
        }
        $size = $length > $this->totalItems - $offset ? $this->totalItems - $offset : $length;

        return array_fill(0, $size, null);
    }

    /**
     * @inheritDoc
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }
}
