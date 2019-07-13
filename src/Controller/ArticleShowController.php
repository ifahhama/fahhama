<?php
// src/Controller/ArticleShowController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Article;
use App\Entity\Categories;

class ArticleShowController extends AbstractController
{
    public function showArticle($id)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em
        ->createQueryBuilder()
        ->select('a.id, a.Tile, a.Body, a.ShortDescription, a.Url')
        ->from(Article::class, 'a')
        ->where('a.id = :idArticle')
        ->setParameter('idArticle', $id)
        ->orderBy('a.id','DESC')
        ->getQuery()->getResult();

        $menus = $em
        ->createQueryBuilder()
        ->select('c.id, c.Name')
        ->from(Categories::class, 'c')
        ->orderBy('c.id','DESC')
        ->getQuery()->getResult();

        return $this->render(
            'Article/Show.html.twig',
            [
                'Articles' => $articles,
                'Menus' => $menus
            ]
        );
    }
}