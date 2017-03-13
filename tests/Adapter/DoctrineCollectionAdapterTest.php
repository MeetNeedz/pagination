<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter;

use Doctrine\Common\Collections\ArrayCollection;
use MeetNeedz\Component\Paginator\Adapter\DoctrineCollectionAdapter;

/**
 * Class DoctrineCollectionAdapterTest
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class DoctrineCollectionAdapterTest extends \PHPUnit_Framework_TestCase implements AdapterTestInterface
{
    use AdapterTestTrait;

    /**
     * @inheritDoc
     */
    public function getAdapter()
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
    public function isAvailable()
    {
        return interface_exists('Doctrine\Common\Collections\Collection') && class_exists('Doctrine\Common\Collections\ArrayCollection');
    }
}
