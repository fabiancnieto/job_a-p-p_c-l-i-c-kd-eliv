<?php

namespace AppBundle\Controller\Ums;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("/UMS", name="UMS")
 */
class UserController extends Controller
{
    /**
     * @var user
     */
    private $user;

    /**
     * Lists all user entities.
     *
     * @Route("/Users", name="Ums_index")
     * @Method("GET")
     * @Security("has_role('ROLE_AGENT')")
     */
    public function indexAction()
    {
        $userLogIn = $this->getUser();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render(
         'Ums/user/index.html.twig', 
         array(
            'users' => $users,
            'sec' => array(
                'role' => $userLogIn->getPru()->getPruName(),
                'name' => $userLogIn->getUsrFullName(),
                'grant' => $userLogIn->getUsrGrantList(),
                'id' => $userLogIn->getUsrId(),
            )
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/Users/new", name="Ums_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $userLogIn = $this->getUser();
        $this->user = new User();
        $form = $this->createForm('AppBundle\Form\Ums\UserType', $this->user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $this->setEncryptPassword();
            $em->persist($this->user);
            $em->flush();

            return $this->redirectToRoute('Ums_show', array('usrId' => $this->user->getUsrid()));
        }

        return $this->render('Ums/user/new.html.twig', array(
            'user' => $this->user,
            'form' => $form->createView(),
            'sec' => array(
                'role' => $userLogIn->getPru()->getPruName(),
                'name' => $userLogIn->getUsrFullName(),
                'grant' => $userLogIn->getUsrGrantList(),
                'id' => $userLogIn->getUsrId(),
            )
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/Users/{usrId}", name="Ums_show")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function showAction(User $user)
    {
        $userLogIn = $this->getUser();
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('Ums/user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
            'sec' => array(
                'role' => $userLogIn->getPru()->getPruName(),
                'name' => $userLogIn->getUsrFullName(),
                'grant' => $userLogIn->getUsrGrantList(),
                'id' => $userLogIn->getUsrId(),
            )
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/Users/{usrId}/edit", name="Ums_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function editAction(Request $request, User $user)
    {
        $this->user = $user;
        $userLogIn = $this->getUser();
        $deleteForm = $this->createDeleteForm($this->user);
        $editForm = $this->createForm('AppBundle\Form\Ums\UserType', $this->user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $role = $userLogIn->getRoles();
            $this->setEncryptPassword();

            $this->getDoctrine()->getManager()->merge($this->user);
            $this->getDoctrine()->getManager()->flush();

            if($role[0] == "ROLE_ADMIN"){
                return $this->redirectToRoute('Ums_index');
            } else {
                return $this->redirectToRoute('Ums_show', array('usrId' => $userLogIn->getUsrid()));
            }
        }

        return $this->render('Ums/user/edit.html.twig', array(
            'user' => $this->user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'sec' => array(
                'role' => $userLogIn->getPru()->getPruName(),
                'name' => $userLogIn->getUsrFullName(),
                'grant' => $userLogIn->getUsrGrantList(),
                'id' => $userLogIn->getUsrId(),
            )
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/Users/{usrId}", name="Ums_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('Ums_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Ums_delete', array('usrId' => $user->getUsrid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Encode the user plain password and add to the entity User
     */
    private function setEncryptPassword(){
        // Encode the new users password
        $encrpyt = $this->get('security.password_encoder');
        $password = $encrpyt->encodePassword($this->user, $this->user->getPassword());
        $this->user->setPassword($password);
    }
}
