<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * @Route("/admin/log_out", name="admin_log_out")
     */
    public function log_out()
    {
        // return $this->render("admin/$slug.html.twig", [
        //     'title' => "$slug",
        // ]);
        // Сброс авторизатиции, redirect на главную
    }

    /**
     * @Route("/admin/add", name="admin_add")
     */
    public function add()
    {   
        // Работа с формами, добавление в базу данных
        return $this->render("admin/add.html.twig", [
            'title' => "Add post",
        ]);
    }

    /**
     * @Route("/admin/edit", name="admin_edit")
     */
    public function edit()
    {   
        // Работа с формами, изменение в базе данных
        return $this->render("admin/edit.html.twig", [
            'title' => "Edit post",
        ]);
    }

    /**
     * @Route("/admin/posts", name="admin_posts")
     */
    public function posts()
    {   
        // Получение всех постов из базы данных
        return $this->render("admin/posts.html.twig", [
            'title' => "Posts",
        ]);
    }

    /**
     * @Route("/admin/del", name="admin_del")
     */
    public function del()
    {
        // return $this->render("admin/$slug.html.twig", [
        //     'title' => "$slug",
        // ]);
        // Получение списка постов, удаление из базы данных
    }
}
