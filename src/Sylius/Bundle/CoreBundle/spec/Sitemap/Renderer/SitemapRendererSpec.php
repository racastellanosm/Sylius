<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace spec\Sylius\Bundle\CoreBundle\Sitemap\Renderer;
 
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\CoreBundle\Sitemap\Model\Sitemap;
use Sylius\Bundle\CoreBundle\Sitemap\Renderer\RendererAdapterInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class SitemapRendererSpec extends ObjectBehavior
{
    function let(RendererAdapterInterface $adapter)
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\CoreBundle\Sitemap\Renderer\SitemapRenderer');
    }

    function it_implements_sitemap_renderer_interface()
    {
        $this->shouldImplement('Sylius\Bundle\CoreBundle\Sitemap\Renderer\SitemapRendererInterface');
    }

    function it_has_renderer_adapter(RendererAdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
        $this->getAdapter()->shouldReturn($adapter);
    }

    function it_renders_sitemap(
        Sitemap $sitemap,
        Collection $urlSet,
        $adapter
    ) {
        $sitemap->getTemplate()->willReturn('@SyliusCore/Sitemap/url_set.xml.twig');
        $sitemap->getUrlSet()->willReturn($urlSet);
        $adapter->render('@SyliusCore/Sitemap/url_set.xml.twig', array('url_set' => $urlSet))->shouldBeCalled();

        $this->render($sitemap);
    }
}
