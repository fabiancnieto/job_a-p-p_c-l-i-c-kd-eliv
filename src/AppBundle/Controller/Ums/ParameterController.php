<?php

namespace AppBundle\Controller\Ums;

use AppBundle\Entity\Parameter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * Parameter controller.
 *
 * @Route("/UMS", name="Parameters")
 */
class ParameterController extends Controller
{
    /**
     * Lists all parameter entities.
     *
     * @Route("/Parameters", name="parameter_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $userLogIn = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $parameters = $em->getRepository('AppBundle:Parameter')->findAll();

        return $this->render(
          'Ums/parameter/index.html.twig', array(
            'parameters' => $parameters,
            'sec' => array(
                'role' => $userLogIn->getPru()->getPruName(),
                'name' => $userLogIn->getUsrFullName(),
                'grant' => $userLogIn->getUsrGrantList(),
                'id' => $userLogIn->getUsrId(),
            )
        ));
    }

    /**
     * Creates a new parameter entity.
     *
     * @Route("/Parameters/new", name="parameter_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $userLogIn = $this->getUser();
        $parameter = new Parameter();
        $form = $this->createForm('AppBundle\Form\Ums\ParameterType', $parameter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parameter);
            $em->flush();

            return $this->redirectToRoute('parameter_show', array('parId' => $parameter->getParid()));
        }

        return $this->render('Ums/parameter/new.html.twig', array(
            'parameter' => $parameter,
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
     * Finds and displays a parameter entity.
     *
     * @Route("/Parameters/{parId}", name="parameter_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Parameter $parameter)
    {
        $userLogIn = $this->getUser();
        $deleteForm = $this->createDeleteForm($parameter);

        return $this->render('Ums/parameter/show.html.twig', array(
            'parameter' => $parameter,
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
     * Displays a form to edit an existing parameter entity.
     *
     * @Route("/Parameters/{parId}/edit", name="parameter_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Parameter $parameter)
    {
        $userLogIn = $this->getUser();
        $deleteForm = $this->createDeleteForm($parameter);
        $editForm = $this->createForm('AppBundle\Form\Ums\ParameterType', $parameter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parameter_edit', array('parId' => $parameter->getParid()));
        }

        return $this->render('Ums/parameter/edit.html.twig', array(
            'parameter' => $parameter,
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
     * Deletes a parameter entity.
     *
     * @Route("/Parameters/{parId}", name="parameter_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Parameter $parameter)
    {
        $form = $this->createDeleteForm($parameter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parameter);
            $em->flush();
        }

        return $this->redirectToRoute('parameter_index');
    }

    /**
     * Creates a form to delete a parameter entity.
     *
     * @param Parameter $parameter The parameter entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Parameter $parameter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parameter_delete', array('parId' => $parameter->getParid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
