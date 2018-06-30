<?php

namespace AppBundle\Menu;

use RickWest\MenuBuilderBundle\MenuBuilder\MenuBuilderFactoryInterface;
use RickWest\MenuBuilderBundle\MenuBuilder\MenuBuilderFactory;
use RickWest\MenuBuilderBundle\MenuBuilder\MenuBuilderInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class MainMenu
 * @package AppBundle\Menu
 */
class MainMenu implements MenuBuilderInterface
{
    /** @var MenuBuilderFactory $menuBuilder */
    protected $menuBuilder;

    /** @var RouterInterface $router */
    protected $router;

    /** @var TranslatorInterface $translator */
    protected $translator;

    /** @var Security $security */
    protected $security;

    /**
     * MainMenu constructor.
     * @param MenuBuilderFactoryInterface $menuBuilder
     * @param RouterInterface $router
     * @param TranslatorInterface $translator
     * @param Security $security
     */
    public function __construct(
        MenuBuilderFactoryInterface $menuBuilder,
        RouterInterface $router,
        TranslatorInterface $translator,
        Security $security
    ) {
        $this->menuBuilder = $menuBuilder;
        $this->router = $router;
        $this->translator = $translator;
        $this->security = $security;
    }

    /**
     * @return \RickWest\MenuBuilderBundle\Models\Menu
     */
    public function build()
    {
        // Create a new menu instance
        $menu = $this->menuBuilder->create('main_menu');

        // Check for an authenticated user and build appropriate menu
        if ($this->security->getToken() && $this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $menu->addItem($this->menuBuilder->item('#', $this->translator->trans(
                'layout.logged_in_as', ['%username%' => $this->security->getUser()->getUsername()], 'FOSUserBundle'
            ), ['children' => [
                $this->menuBuilder->item($this->router->generate('fos_user_profile_show'), 'Profile'),
                $this->menuBuilder->item($this->router->generate('fos_user_change_password'), 'Password'),
                $this->menuBuilder->item($this->router->generate('fos_user_security_logout'), $this->translator->trans('layout.logout', [], 'FOSUserBundle')),
            ]
            ]));
        } else {
            $menu
                ->addItem($this->menuBuilder->item($this->router->generate('fos_user_security_login'), $this->translator->trans('layout.login', [], 'FOSUserBundle')))
                ->addItem($this->menuBuilder->item($this->router->generate('fos_user_registration_register'), $this->translator->trans('layout.register', [], 'FOSUserBundle')))
            ;
        }
        return $menu;
    }
}