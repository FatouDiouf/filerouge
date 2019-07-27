<?php

namespace App\Controller;

use App\Entity\Users;
<<<<<<< HEAD
use App\Entity\Partenaire;
=======
use App\Repository\UsersRepository;
>>>>>>> d03c8b806dd2f50939d11701c1a34fa7009bcb6f
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//use Symfony\Component\BrowserKit\Response;

/**
 *  @Route("/api")
 */
class SecuriteController extends AbstractController
{
    /**
     * @Route("/securite", name="securite")
     */
    public function index()
    {
        return $this->render('securite/index.html.twig', [
            'controller_name' => 'SecuriteController',
        ]);
    }


    /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->username,$values->password)) {
            $user = new Users();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setRoles($user->getRoles());
            $user->setNom($values->nom);
            $user->setEmail($values->email);
            $user->setAdresse($values->adresse);
            $user->setTelephone($values->telephone);

            $repo = $this->getDoctrine()->getRepository(Partenaire::class);
            $partenaires = $repo->find($values->partenaire);
            $user->setPartenaire($partenaires);
            
            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'statu' => 500,
            'messag' => 'Vous devez renseigner les clés username et password'
        ];
        return new JsonResponse($data, 500);
    }

     /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUsers();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }

<<<<<<< HEAD
     /**
     * @Route("/partenaire", name="add_partenaire", methods={"POST"})
     */

    public function ajout(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $partenaire= $serializer->deserialize($request->getContent(), Partenaire::class, 'json');
        $entityManager->persist($partenaire);
        $entityManager->flush();
        $data = [
            'vue' => 201,

            'afficher' => 'Le partenaire a bien été ajouté'
        ];

        return new JsonResponse($data, 201);
    }

        /**
        * @Route("/partenaires/{id}", name="update_partenaire", methods={"PUT"})
        */
        public function update(Request $request, SerializerInterface $serializer, Partenaire $partenaire, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    
        {
            $partenaireUpdate = $entityManager->getRepository(Partenaire::class)->find($partenaire->getId());
            $data = json_decode($request->getContent());
            foreach ($data as $key => $value){
                if($key && !empty($value)) {
                    $name = ucfirst($key);
                    $setter = 'set'.$name;
                    $partenaireUpdate->$setter($value);
                }
            }
            $errors = $validator->validate($partenaireUpdate);
            if(count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                    ]);
                }
                $entityManager->flush();
                $data = [
                    'status' => 200,
                    'message' => 'Le partenaire a bien été mis à jour'
                ];
                return new JsonResponse($data);
            }
=======

     /**
     * @Route("/liste", name="liste", methods={"POST"})
     */
    public function liste(UsersRepository $usersRepository,SerializerInterface $serializer)
    {
        // $liste = $this->getDoctrine()->getRepository(Employer::class);
        // $users = $liste->findAll(); 
        $user = $usersRepository->findAll();
         $liste = $serializer->serialize($user,'json');

         return new Response($liste, 200, [
             'content-Type' => 'application/json'
         ]
        );
        
    }

     /**
     * @Route("/Users/{id}", name="update_users", methods={"PUT"})
     */
    public function update(Request $request, SerializerInterface $serializer, Users $users, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $usersUpdate = $entityManager->getRepository(Users::class)->find($users->getId());
        $data = json_decode($request->getContent());
        foreach ($data as $key => $value){
            if($key && !empty($value)) {
                $name = ucfirst($key);
                $setter = 'set'.$name;
                $usersUpdate->$setter($value);
            }
        }
        $errors = $validator->validate($usersUpdate);
        if(count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'status' => 200,
            'message' => 'L utilisateur a bien été mis à jour'
        ];
        return new JsonResponse($data);
    }
>>>>>>> d03c8b806dd2f50939d11701c1a34fa7009bcb6f
}
