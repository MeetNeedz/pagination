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
    public function getSlice($offset, $length = null, $preserveKeys = false)
    {
        $offset = $offset < 0 ? $offset + $this->getTotalItems() : $offset;

        if ($this->totalItems < $offset) {
            return [];
        }
        $size = $length === null || $length > $this->totalItems - $offset ? $this->totalItems - $offset : $length;

        return array_fill($preserveKeys ? $offset : 0, $size, null);
    }

    /**
     * @inheritDoc
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }
}
