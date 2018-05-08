<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {   
        $data = [
            [
                'id' => 1,
                'author' => "John",
                'category' => "sport",
                'header' => 'Lorem ipsum dolor sit amet.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas alias inventore, facilis consequuntur quae quidem culpa reiciendis, impedit magni nihil itaque eos debitis dolore vero ut nobis corporis quia, totam.'
            ],
            [
                'id' => 2,
                'author' => 'Piter',
                'category' => 'food',
                'header' => 'Lorem consectetur adipisicing elit.',
                'description' => 'Quas alias inventore, facilis consequuntur quae quidem culpa reiciendis, impedit magni nihil.'
            ],
            [
                'id' => 3,
                'author' => 'Patrik',
                'category' => 'weather',
                'header' => 'Aspernatur adipisci illum quos mollitia.',
                'description' => 'Impedit magni nihil itaque eos debitis dolore vero ut nobis corporis quia, totam.'
            ]
        ];

        if (!$data) {
            throw $this->createNotFoundException('The articles does not exists');
        }

        return $this->render('main/index.html.twig', [
            'data' => $data,
            'title' => 'Homepage',
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
