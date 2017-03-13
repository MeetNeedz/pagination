<?php
namespace MeetNedz\Component\Paginator\Tests\Adapter;

use Doctrine\Common\Collections\ArrayCollection;
use MeetNeedz\Component\Paginator\Adapter\DoctrineCollectionAdapter;
use MeetNeedz\Component\Paginator\Tests\Adapter\AbstractAdapterTest;

/**
 * Class DoctrineCollectionAdapterTest
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class DoctrineCollectionAdapterTest extends AbstractAdapterTest
{
    /**
     * @inheritDoc
     */
    protected function getAdapter()
    {
        $data = [];
        for ($i = 0; $i < 42; $i++) {
            $data[] = 'collection-item-' . ($i + 1);
        }
        $collection = new ArrayCollection($data);
        return new DoctrineCollectionAdapter($collection);
    }

    /**
     * @inheritDoc
     */
    protected function isAvailable()
    {
        return interface_exists('Doctrine\Common\Collections\Collection') && class_exists('Doctrine\Common\Collections\ArrayCollection');
    }
}
