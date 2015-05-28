<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Amphibians;
use AppBundle\Form\AmphibiansType;

/**
 * Amphibians controller.
 *
 * @Route("/admin/amphibians")
 */
class AmphibiansController extends Controller
{

    /**
     * Lists all Amphibians entities.
     *
     * @Route("/", name="admin_amphibians")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Amphibians')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Amphibians entity.
     *
     * @Route("/", name="admin_amphibians_create")
     * @Method("POST")
     * @Template("AppBundle:Amphibians:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Amphibians();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_amphibians_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Amphibians entity.
     *
     * @param Amphibians $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Amphibians $entity)
    {
        $form = $this->createForm(new AmphibiansType(), $entity, array(
            'action' => $this->generateUrl('admin_amphibians_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Amphibians entity.
     *
     * @Route("/new", name="admin_amphibians_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Amphibians();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Amphibians entity.
     *
     * @Route("/{id}", name="admin_amphibians_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Amphibians')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Amphibians entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Amphibians entity.
     *
     * @Route("/{id}/edit", name="admin_amphibians_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Amphibians')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Amphibians entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Amphibians entity.
    *
    * @param Amphibians $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Amphibians $entity)
    {
        $form = $this->createForm(new AmphibiansType(), $entity, array(
            'action' => $this->generateUrl('admin_amphibians_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Amphibians entity.
     *
     * @Route("/{id}", name="admin_amphibians_update")
     * @Method("PUT")
     * @Template("AppBundle:Amphibians:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Amphibians')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Amphibians entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_amphibians_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Amphibians entity.
     *
     * @Route("/{id}", name="admin_amphibians_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Amphibians')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Amphibians entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_amphibians'));
    }

    /**
     * Creates a form to delete a Amphibians entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_amphibians_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
