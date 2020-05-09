<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class AccountController extends AbstractController
{
    /**
     * @Route("/admin/mon_compte", name="account")
     */
    public function editAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)

    {
        $allUser = $this->getDoctrine()->getRepository(User::class)->findAll();
        $user = $this->getUser();
    	$form = $this->createForm(ResetPasswordType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = (new \Swift_Message('Modification mot de passe'))
                ->setFrom('cleo.cosnier@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                        $this->renderView(
                            'emails/resetPassword.html.twig', [
                                'user'=>$user,
                            ]
                        ),
                        'text/html'
                    );
            $mailer->send($message);

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe à bien été modifié !');
            return $this->redirectToRoute('admin_index');
            
        }

    	

    	return $this->render('admin/account.html.twig', array(

            'resetPassword' => $form->createView(),
            "name" => "Modifier votre mot de passe",
            

    	));

    }
}
