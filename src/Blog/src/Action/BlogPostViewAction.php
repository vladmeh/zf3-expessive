<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace Blog\Action;

use Blog\Entity\BlogPost;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Code\Exception\RuntimeException;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class BlogPostViewAction implements ServerMiddlewareInterface
{

    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * BlogPostViewAction constructor.
     * @param EntityManager $entityManager
     * @param RouterInterface $router
     * @param TemplateRendererInterface $templateRenderer
     */
    public function __construct(EntityManager $entityManager, RouterInterface $router, TemplateRendererInterface $templateRenderer = null)
    {
        $this->router = $router;
        $this->templateRenderer = $templateRenderer;
        $this->entityManager = $entityManager;
    }


    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);
        $routeMatchedParams = $routeResult->getMatchedParams();

        if (empty($routeMatchedParams['blog_post_id'])) {
            throw new RuntimeException('Invalid route: "blog_post_id" not set in matched route params.');
        }

        $blogId = $routeMatchedParams['blog_post_id'];

        /** @var BlogPost $blogPost */
        $blogPost = $this->entityManager->find(BlogPost::class, $blogId);
        if (!$blogPost){
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);
        }

        $data = [
            'post' => $blogPost,
        ];

        return new HtmlResponse($this->templateRenderer->render('blog::view', $data));
    }
}