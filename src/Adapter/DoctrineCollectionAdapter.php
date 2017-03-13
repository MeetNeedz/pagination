<?php
namespace MeetNeedz\Component\Paginator\Adapter;

use Doctrine\Common\Collections\Collection;

/**
 * Class DoctrineCollectionAdapter
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class DoctrineCollectionAdapter implements AdapterInterface
{
    /**
     * Contains the collection.
     *
     * @var Collection
     */
    private $collection;

    /**
     * Constructor.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @inheritDoc
     */
    public function getSlice($offset, $length)
    {
        return $this->collection->slice($offset, $length);
    }

    /**
     * @inheritDoc
     */
    public function getTotalItems()
    {
        return $this->collection->count();
    }
}
