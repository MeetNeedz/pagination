<?php
namespace MeetNeedz\Component\Paginator;

use MeetNeedz\Component\Paginator\Adapter\AdapterInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Paginator
 *
 * @author Raphael De Freitas <raphael.defreitas@meetneedz.com>
 */
class Paginator implements PaginatorInterface
{
    /**
     * Contains the options resolver.
     *
     * @var OptionsResolver
     */
    private $optionsResolver;

    /**
     * Constructor.
     *
     * @param OptionsResolver|null $optionsResolver
     */
    public function __construct(OptionsResolver $optionsResolver = null)
    {
        $this->optionsResolver = $optionsResolver ?: new OptionsResolver();
    }

    /**
     * @inheritDoc
     */
    public function paginate(AdapterInterface $adapter, array $options = [])
    {
        $this->configureOptionsResolver();
        $options = $this->optionsResolver->resolve($options);

        $pagination = new Pagination($adapter);
        $pagination->setCurrentPage($options['current_page']);
        $pagination->setItemsPerPage($options['items_per_page']);

        return $pagination;
    }

    /**
     * Configures the options resolver
     */
    protected function configureOptionsResolver()
    {
        $this->optionsResolver->setDefaults([
            'current_page' => 1,
            'items_per_page' => 10
        ]);
    }
}
