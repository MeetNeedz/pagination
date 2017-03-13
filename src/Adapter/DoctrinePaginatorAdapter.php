<?php
namespace MeetNeedz\Component\Paginator\Adapter;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class DoctrinePaginationAdapter
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class DoctrinePaginatorAdapter implements AdapterInterface
{
    /**
     * Contains the paginator.
     *
     * @var Paginator
     */
    private $paginator;

    /**
     * Constructor.
     * @param Query|QueryBuilder $query
     * @param bool $fetchJoinCollection
     * @param bool|null $useOutputWalkers
     */
    public function __construct($query, $fetchJoinCollection = true, $useOutputWalkers = null)
    {
        $this->paginator = new Paginator($query, $fetchJoinCollection);
        $this->paginator->setUseOutputWalkers($useOutputWalkers);
    }

    /**
     * @inheritDoc
     */
    public function getSlice($offset, $length)
    {
        $this->paginator
            ->getQuery()
            ->setFirstResult($offset)
            ->setMaxResults($length);

        return $this->paginator->getIterator();
    }

    /**
     * @inheritDoc
     */
    public function getTotalItems()
    {
        return $this->paginator->count();
    }
}
