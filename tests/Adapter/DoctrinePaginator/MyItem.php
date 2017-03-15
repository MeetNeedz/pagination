<?php
namespace MeetNeedz\Component\Paginator\Tests\Adapter\DoctrinePaginator;

/**
 * Class MyItem
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 *
 * @Entity
 */
class MyItem
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
     * Contains the list.
     *
     * @var MyList
     *
     * @ManyToOne(targetEntity = "MyList", inversedBy = "items")
     * @JoinColumn(name = "list", referencedColumnName = "id")
     */
    public $list;

    /**
     * Contains the value.
     *
     * @var string
     *
     * @Column(type = "string", length = 255)
     */
    public $value;
}