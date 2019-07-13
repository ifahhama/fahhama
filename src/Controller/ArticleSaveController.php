<?php
// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Article;
use App\Entity\Categories;

class ArticleSaveController extends AbstractController
{
    public function saveArticle()
    {   
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $session = new Session();
        if($session->has('Saved')) {

            $request = Request::createFromGlobals();
            $em = $this->getDoctrine()->getManager();
            $article = $request->request->get('form');
            $file = $request->files->get('form');
            $file = $file['Url'];
            $newFileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'), $newFileName);
    
            $Cat = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->find($article['categorie']);
    
            $newArticle = new Article();
            $newArticle->setTile($article['Tile']);
            $newArticle->setBody($article['Body']);
            $newArticle->setDateCreated(new \DateTime('now'));
            $newArticle->setAuthor('Admin');
            $newArticle->setShortDescription($article['ShortDescription']);
            $newArticle->setUrl($newFileName);
            $newArticle->setCategorie($Cat);
    
            $em->persist($newArticle);
            $em->flush();
            $session->set('Saved', false);
        } else {
            return $this->redirectToRoute('app_addArticle');
        }

        return $this->redirectToRoute('app_home');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }    
}