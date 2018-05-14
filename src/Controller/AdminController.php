<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Posts;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'title' => 'Admin Panel',
        ]);
    }

    /**
     * @Route("/admin/sign_out", name="exit")
     */
    public function exit()
    {
        // return $this->render("admin/$slug.html.twig", [
        //     'title' => "$slug",
        // ]);
        // Сброс авторизатиции, redirect на главную
    }

    /**
     * @Route("/admin/add", name="addPost")
     */
    public function addPost(Request $request)
    {   
        $post = new Posts();
        
        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('content', TextType::class)
            ->add('category', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $addPost = $form->getData();

            //add adminData from the form to database            
            $repository = $this->getDoctrine()->getManager();
            $repository->persist($addPost);
            $repository->flush();

            return $this->redirectToRoute('addPost');
        }

        return $this->render('admin/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/edit", name="editPost")
     */
    public function editPost()
    {   
        // Работа с формами, изменение в базе данных
        return $this->render("admin/edit.html.twig", [
            'title' => "Edit post",
        ]);
    }

    /**
     * @Route("/admin/posts", name="posts")
     */
    public function posts()
    {   
        // Получение всех постов из базы данных
        return $this->render("admin/posts.html.twig", [
            'title' => "Posts",
        ]);
    }

    /**
     * @Route("/admin/del", name="delPost")
     */
    public function del()
    {
        // return $this->render("admin/$slug.html.twig", [
        //     'title' => "$slug",
        // ]);
        // Получение списка постов, удаление из базы данных
    }
}
