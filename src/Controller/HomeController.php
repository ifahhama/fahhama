<?php
// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Article;
use App\Entity\Categories;

class HomeController extends AbstractController
{
    public function accueil()
    {
        return new Response(
            '<html><body>Lucky the site is Ok</body></html>'
        );
        /*$em = $this->getDoctrine()->getManager();
        $articles = $em
        ->createQueryBuilder()
        ->select('a.id, a.Tile, a.Body, a.ShortDescription, a.Url')
        ->from(Article::class, 'a')
        ->orderBy('a.id','DESC')
        ->getQuery()->getResult();

        $menus = $em
        ->createQueryBuilder()
        ->select('c.id, c.Name')
        ->from(Categories::class, 'c')
        ->orderBy('c.id','DESC')
        ->getQuery()->getResult();
        
        return $this->render(
            'Home/home.html.twig',
            [
                'Articles' => $articles,
                'Menus' => $menus
            ]
        );*/
    }
}