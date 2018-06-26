<?php

namespace AppBundle\Menu;

use RickWest\MenuBuilderBundle\MenuBuilder\MenuBuilderFactoryInterface;
use RickWest\MenuBuilderBundle\MenuBuilder\MenuBuilderFactory;
use RickWest\MenuBuilderBundle\MenuBuilder\MenuBuilderInterface;

class MenuBuilder implements MenuBuilderInterface
{
    /** @var MenuBuilderFactory  */
    protected $menuBuilderFactory;

    public function __construct(MenuBuilderFactoryInterface $menuBuilderFactory)
    {
        $this->menuBuilderFactory = $menuBuilderFactory;
    }

    public function build()
    {
        // build menu here
    }
}