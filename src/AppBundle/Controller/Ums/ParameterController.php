<?php

namespace AppBundle\Controller\Ums;

use AppBundle\Entity\Parameter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Parameter controller.
 *
 * @Route("/", name="Parameters")
 */
class ParameterController extends Controller
{
    /**
     * Lists all parameter entities.
     *
     * @Route("/Parameters", name="parameter_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parameters = $em->getRepository('AppBundle:Parameter')->findAll();

        return $this->render(
          'Ums/parameter/index.html.twig', array(
            'parameters' => $parameters,
        ));
    }

    /**
     * Creates a new parameter entity.
     *
     * @Route("/Parameters/new", name="parameter_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
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
        ));
    }

    /**
     * Finds and displays a parameter entity.
     *
     * @Route("/Parameters/{parId}", name="parameter_show")
     * @Method("GET")
     */
    public function showAction(Parameter $parameter)
    {
        $deleteForm = $this->createDeleteForm($parameter);

        return $this->render('Ums/parameter/show.html.twig', array(
            'parameter' => $parameter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing parameter entity.
     *
     * @Route("/Parameters/{parId}/edit", name="parameter_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Parameter $parameter)
    {
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
        ));
    }

    /**
     * Deletes a parameter entity.
     *
     * @Route("/Parameters/{parId}", name="parameter_delete")
     * @Method("DELETE")
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
