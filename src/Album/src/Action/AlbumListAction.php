<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Album\Action;

use Album\Model\AlbumModel;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class AlbumListAction implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var AlbumModel
     */
    private $albumModel;

    /**
     * AlbumListAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param AlbumModel $albumModel
     */
    public function __construct(TemplateRendererInterface $templateRenderer, AlbumModel $albumModel)
    {
        $this->templateRenderer = $templateRenderer;
        $this->albumModel = $albumModel;
    }


    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $albums = $this->albumModel;

        $data = [
            'posts' => $albums::all(),
        ];

        return new HtmlResponse($this->templateRenderer->render('album::list', $data));
    }
}