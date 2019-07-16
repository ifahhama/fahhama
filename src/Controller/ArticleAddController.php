<?php
// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Article;
use App\Entity\Categories;

class ArticleAddController extends AbstractController
{
    public function addArticle()
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        } catch (Exception $e) {

        }
        $session = new Session();
        $session->set('Saved', true);

        $em = $this->getDoctrine()->getManager();
        $menus = $em
        ->createQueryBuilder()
        ->select('c.id, c.Name')
        ->from(Categories::class, 'c')
        ->orderBy('c.id','DESC')
        ->getQuery()->getResult();
        
        $article = new Article();
        $article->setDateCreated(new \DateTime('now'));

        $form = $this->createFormBuilder($article)
            ->setAction($this->generateUrl('app_save'))
            ->setMethod('GET')        
            ->add('Tile', TextType::class)
            ->add('Body', TextareaType::class)
            ->add('DateCreated', DateType::class)
            ->add('Author', DateType::class)
            ->add('Url', FileType::class)
            ->add('categorie', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'Name',
            ])
            ->add('ShortDescription', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();


        
        return $this->render(
            'Article/add.html.twig',
            [
                'form' => $form->createView(),
                'Menus' => $menus
            ]
        );
    }
}