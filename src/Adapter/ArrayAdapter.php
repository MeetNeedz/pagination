<?php
namespace MeetNeedz\Component\Paginator\Adapter;

/**
 * Class ArrayAdapter
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class ArrayAdapter implements AdapterInterface
{
    /**
     * Contains the array.
     *
     * @var array
     */
    private $array;

    /**
     * Constructor.
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * @inheritDoc
     */
    public function getSlice($offset, $length)
    {
        return array_slice($this->array, $offset, $length);
    }

    /**
     * @inheritDoc
     */
    public function getTotalItems()
    {
        return count($this->array);
    }
}
