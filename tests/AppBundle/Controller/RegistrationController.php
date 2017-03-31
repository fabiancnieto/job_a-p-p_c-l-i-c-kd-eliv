<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Ums\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/Register", name="ums_register")
     */
    public function registerAction(Request $request)
    {
        // Create a new instance of user and process the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encrypt the new users password
            $encrypt = $this->get('security.password_encoder');
            $password = $encrypt->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Set their role
            $user->setRole('ROLE_USER');

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('ums_login');
        }

        return $this->render('Register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
