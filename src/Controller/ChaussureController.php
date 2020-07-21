<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chaussure;
use App\Entity\Couleur;
use DateTime;
use Doctrine\Common\persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;



class ChaussureController extends AbstractController
{
    /**
     * @Route("/chaussures", name="chaussures")
     */
    public function index(SerializerInterface $serializer)
    {
       
        $repo = $this->getDoctrine()->getRepository(Chaussure::class);
        $result = $repo->findAll();
        // foreach($result as $val){
        //     $resultCouleur = $val->getCouleur();
        //     var_dump($val);
        // }
        $jsonContent = $serializer->serialize($result, 'json', ['groups' => 'group1']);

        return $this->json([
            'data' => $jsonContent,
        ]);
    }

    /**
     * @Route("/chaussures/create", name="create", methods={"POST"})
     */
     public function create(Request $request)
     {
        if($request->isMethod('POST')) {
            $manager = $this->getDoctrine()->getManager();
            $repoCouleur = $this->getDoctrine()->getRepository(Couleur::class);
            $data = json_decode($request->getContent(), true);
            var_dump($data);

            $chaussure = new Chaussure();
            $couleurObject = $repoCouleur->findOneBy(['nom' => $data['couleur']]);
            if($couleurObject) {
                $chaussure->setCouleur($couleurObject);
            }
            $chaussure->setMarque($data['marque']);
            $chaussure->settype($data['type']);
            $chaussure->setPrix($data['prix']);
            $chaussure->setMatiere($data['matiere']);
            $chaussure->setDateVente(new DateTime($data['date']));
            $manager->persist($chaussure);
            $manager->flush();

            return $this->json([
                'response' => 200,
            ]);
        }

        return $this->json([
            'response' => 404,
        ]);
     }

     /**
     * @Route("/chaussures/update/id", name="update", methods={"PUT"})
     */
    public function edit(int $id, Request $request)
    {
       
    }

    /**
     * @Route("/chaussures/delete/id", name="delete", methods={"DELETE"})
     */
    public function delete(int $id, Request $request)
    {
       
    }

    /**
     * @Route("/chaussures/test", name="test", methods={"GET"})
     */
    public function test()
    {
        throw $this->createNotFoundException('The product does not exist');

        return new Response('sds');
    }
}
