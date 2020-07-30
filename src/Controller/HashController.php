<?php

namespace App\Controller;

use App\Entity\HashSite;
use App\Entity\Site;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\SiteRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Service\UrlConstraintHelper;

/**
 * HashController
 * @Route("/api")
*/
class HashController extends AbstractController
{
    /**
     * index Récupére tous les url encoder
     * @Route("/all", name="hash_index")
     * @param $repository   SiteRepository
     * @param $serializer   SerializerInterface
     */
    public function index(SiteRepository $repository, SerializerInterface $serializer)
    {
        return new Response($serializer->serialize($repository->findBy([],['id' => 'DESC']), 'json', ['groups' => 'group1']));
    }

    /**
     * create encode et enregistre la nouvelle url
     * @Route("/create", name="hash_create", methods={"POST"})
     * @param $request  Request
     * @param $request  SerializerInterface
     * @param $request  ValidatorInterface
     * @param $request  UrlConstraintHelper
     */
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, UrlConstraintHelper $urlConstraintHelper)
    {  
        $data = json_decode($request->getContent(), true);
        $url = $data['url'];

        if($request->isMethod('POST') &&  $urlConstraintHelper->checkUrl($url,$validator)) {
           $manager = $this->getDoctrine()->getManager();
           $repoSite = $this->getDoctrine()->getRepository(Site::class);
           $site = $repoSite->findOneBy(['url' => $url]);
           if(!$site){
                $site = new Site();
                $site->setUrl($url);
                $site->setHash(hash('crc32b', $url));
                $manager->persist($site); 
            }
            $manager->flush();
            $serializeData = $serializer->serialize($site, 'json', ['groups' => 'group1']);
            return new Response($serializeData);
       }
       return $this->json('Veuillez saisir une URL valide',400);
    }
}
