<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\Posts;

class MainController extends Controller
{
    /**
     * @Route("/posts", name="posts")
     */
    public function posts()
    {   
        $repository = $this->getDoctrine()->getRepository(Posts::class);

        $posts = $repository->findAll();

        if (!$posts) {
            throw $this->createNotFoundException('The articles does not exists');
        }

        return $this->render('main/posts.html.twig', [
            'posts' => $posts,
            'title' => 'All posts',
        ]);
    }

    /**
     * Matches /posts/*
     *
     * @Route("/posts/{slug}", name="posts_show")
     */
    public function show($slug)
    {
        $repository = $this->getDoctrine()->getRepository(Posts::class);

        $posts = $repository->findBy(
            ['category' => $slug]
        );

        if (!$posts) {
            throw $this->createNotFoundException('The articles does not exists');
        }

        return $this->render('main/posts.html.twig', [
            'posts' => $posts,
            'title' => 'Posts',
        ]);
    }

    /**
     * @Route("/posts/{slug}/{id}", name="blog_show_by_id", requirements={"id"="\d+"})
     */
    public function show_by_id($slug, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Posts::class);

        $post = $repository->find($id);

        if (!$post) {
            throw $this->createNotFoundException('The articles does not exists');
        }

        return $this->render('main/post.html.twig', [
            'post' => $post,
            'title' => 'Posts',
            'path' => '\/' .$slug. '\/',
        ]);
    }

    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function portfolio()
    {
        return $this->render('main/portfolio.html.twig', [
            'title' => 'Portfolio',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('main/contact.html.twig', [
            'title' => 'Contact',
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('main/about.html.twig', [
            'title' => 'About us',
        ]);
    }

    /**
     * @Route("/{url}", name="remove_trailing_slash",
     *     requirements={"url" = ".*\/$"})
     */
     public function removeTrailingSlash(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();

        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);

        return $this->redirect($url, 308);
    }
}
