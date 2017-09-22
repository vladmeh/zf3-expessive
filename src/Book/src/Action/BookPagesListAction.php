<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Book\Action;

use Book\Model\Repository\BookRepositoryInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;


class BookPagesListAction implements ServerMiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;


    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    /**
     * BookPagesListAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(TemplateRendererInterface $templateRenderer, BookRepositoryInterface $bookRepository)
    {
        $this->templateRenderer = $templateRenderer;
        $this->bookRepository = $bookRepository;
    }


    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $books = $this->bookRepository->fetchAllBooks();

        $data = [
            'books' => $books,
        ];

        return new HtmlResponse($this->templateRenderer->render('book::list', $data));
    }
}