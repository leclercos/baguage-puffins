<?php

namespace Parc\PuffinsBagBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Parc\PuffinsBagBundle\Entity\DonneesPrincipales;
use Parc\PuffinsBagBundle\Form\DonneesPrincipalesType;

/**
 * DonneesPrincipales controller.
 *
 * @Route("/donneesprincipales")
 */
class DonneesPrincipalesController extends Controller
{

    /**
     * Lists all DonneesPrincipales entities.
     *
     * @Route("/", name="donneesprincipales")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new DonneesPrincipales entity.
     *
     * @Route("/", name="donneesprincipales_create")
     * @Method("POST")
     * @Template("ParcPuffinsBagBundle:DonneesPrincipales:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new DonneesPrincipales();
        $form = $this->createForm(new DonneesPrincipalesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('donneesprincipales_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new DonneesPrincipales entity.
     *
     * @Route("/new", name="donneesprincipales_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DonneesPrincipales();
        $form   = $this->createForm(new DonneesPrincipalesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DonneesPrincipales entity.
     *
     * @Route("/{id}", name="donneesprincipales_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DonneesPrincipales entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DonneesPrincipales entity.
     *
     * @Route("/{id}/edit", name="donneesprincipales_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DonneesPrincipales entity.');
        }

        $editForm = $this->createForm(new DonneesPrincipalesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing DonneesPrincipales entity.
     *
     * @Route("/{id}", name="donneesprincipales_update")
     * @Method("PUT")
     * @Template("ParcPuffinsBagBundle:DonneesPrincipales:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DonneesPrincipales entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DonneesPrincipalesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('donneesprincipales_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a DonneesPrincipales entity.
     *
     * @Route("/{id}", name="donneesprincipales_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DonneesPrincipales entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('donneesprincipales'));
    }

    /**
     * Creates a form to delete a DonneesPrincipales entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
