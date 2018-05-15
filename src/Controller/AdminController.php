<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Posts;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/admin/sign_out", name="exit")
     */
    public function exit()
    {
        
        // Сброс авторизатиции, redirect на главную
    }

    /**
     * @Route("/admin/add", name="addPost")
     */
    public function addPost(Request $request)
    {   
        $post = new Posts();
        
        //creat a form-addPost, позже попробую вынести в отдельный класс
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

            //add adminData from the form-addPost to database            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addPost);
            $entityManager->flush();

            return $this->redirectToRoute('addPost');
        }

        return $this->render('admin/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/update/{id}", name="updatePost", requirements={"id"="\d+"})
     */
    public function updatePost(Request $request, $id)
    {   
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Posts::class)->find($id);

        if (!$post) {
            throw $this->createNotFoundException('The articles does not exists');
        }

        $newPost = new Posts();

        //set values setTitle(), setDescription(), setContent(), setCategory() from the object $post 
        $newPost->setFormFields($post);

        //creat a form-updatePost, позже попробую вынести в отдельный класс
        $form = $this->createFormBuilder($newPost)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('content', TextType::class)
            ->add('category', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // update post from the form-updatePost in database
            $updatePost = $form->getData();
            
            //set values setTitle(), setDescription(), setContent(), setCategory() from the object $updatePost             
            $post->setFormFields($updatePost);            
            $entityManager->flush();

            //update post in database, but not working redirect
            return $this->redirectToRoute('allPosts');
        }
        
        return $this->render('admin/update.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/posts", name="allPosts")
     */
    public function allPosts()
    {   
        $posts = $this->getDoctrine()->getRepository(Posts::class)->findAll();
        
        return $this->render("admin/posts.html.twig", [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="delPost", requirements={"id"="\d+"})
     */
    public function del($id)
    {   
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Posts::class)->find($id);

        if (!$post) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        
        $entityManager->remove($post);
        $entityManager->flush();

        return $this->redirectToRoute('allPosts');
    }
}
