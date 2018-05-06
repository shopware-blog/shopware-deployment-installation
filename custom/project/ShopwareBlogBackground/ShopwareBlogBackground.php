<?php declare(strict_types=1);

namespace ShopwareBlogBackground;

use Shopware\Components\Plugin;

class ShopwareBlogBackground extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return [
            'Enlight_Controller_Action_PostDispatch_Frontend' => 'onFrontendPostDispatch'
        ];
    }

    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->get('subject');

        /** @var \Enlight_View_Default $view */
        $view = $controller->View();

        $config = $this->container->get('shopware.plugin.config_reader')
            ->getByPluginName($this->getName(), Shopware()->Shop());

        $view->addTemplateDir(
            __DIR__ . '/Views'
        );

        $view->assign($config);
    }
}
