<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter\DoctrinePaginator;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class MyList
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 *
 * @Entity
 */
class MyList
{
    /**
     * Contains the id.
     *
     * @var integer
     *
     * @Id
     * @Column(type = "integer")
     * @GeneratedValue(strategy = "AUTO")
     */
    public $id;

    /**
     * Contains the name.
     *
     * @var string
     *
     * @Column(type = "string", length = 255)
     */
    public $name;

    /**
     * Contains the items.
     *
     * @var array|ArrayCollection|MyList[]
     *
     * @OneToMany(targetEntity = "MyItem", mappedBy = "list")
     */
    public $items;
}