<?php

namespace AbsenceBundle\Controller;

use AbsenceBundle\AbsenceBundle;
use AbsenceBundle\Entity\Absence;
use AbsenceBundle\Entity\Classe;
use AbsenceBundle\Entity\Etudiant;
use AbsenceBundle\Form\AbsenceClasseType;
use AbsenceBundle\Form\AbsenceEditFormType;
use AbsenceBundle\Form\AbsenceEditType;
use AbsenceBundle\Form\AbsenceEtudiantType;
use AbsenceBundle\Form\ClasseEditType;
use AbsenceBundle\Form\AbsenceType;
use AbsenceBundle\Form\ClasseType;
use AbsenceBundle\Form\EtudiantClasseType;
use AbsenceBundle\Form\EtudiantEditType;
use AbsenceBundle\Form\AbsenceParClasseType;
use AbsenceBundle\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name = "user_index")
     */
    public function indexuserAction()
    {
        return $this->render('AbsenceBundle:Default:indexuser.html.twig');
    }



    /**
     * @Route("/absence/list/paretudiant", name = "user_list_absence_etudiant")
     */

    public function listabsenceetudiantuserAction(Request $request)
    {
        $absence = new Absence();
        $form   = $this->get('form.factory')->create(AbsenceEtudiantType::class, $absence);


        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getEtudiant()->getId();
            $nom = $data->getEtudiant()->getNom();
            $session = $request->getSession();
            $session->set('id', $id);
            $session->set('nom', $nom);
            return $this->redirectToRoute('user_list_absence_etudiant_show');
        }

        return $this->render('AbsenceBundle:Default:listabsenceetudiantuser.html.twig', array('f'=> $form->createView()));
    }


    /**
     * @Route("/absence/list/paretudiant/show", name = "user_list_absence_etudiant_show")
     */

    public function listabsenceetudiantshowuserAction(Request $request)
    {
        $session = $request->getSession();
        $id = $session->get('id');
        $nom = $session->get('nom');
        $absences = $this->getDoctrine()->getRepository("AbsenceBundle:Absence")->findBy(array('etudiant' => $id));
        return $this->render('AbsenceBundle:Default:listabsenceetudiantshowuser.html.twig', array('absences' => $absences, 'id' => $id, 'nom' => $nom));
    }



    
    /**
     * @Route("/absence/list/tous", name = "user_list_absence_tous")
     */

    public function listabsencetoususerAction()
    {
        $absences = $this->getDoctrine()->getRepository("AbsenceBundle:Absence")->findAll();
        return $this->render('AbsenceBundle:Default:listabsencetoususer.html.twig', array('absences' => $absences));
    }


















    /**
     * @Route("/admin/", name = "absence_home")
     */
    public function indexAction()
    {
        return $this->render('AbsenceBundle:Default:index.html.twig');
    }

    /**
     * @Route("/admin/etudiant/index", name = "index_etudiant")
     */
    public function indexetudiantAction()
    {
        return $this->render('AbsenceBundle:Default:indexetudiant.html.twig');
    }

    /**
     * @Route("/admin/classe/index", name = "index_classe")
     */
    public function indexclasseAction()
    {
        return $this->render('AbsenceBundle:Default:indexclasse.html.twig');
    }

    /**
     * @Route("/admin/absence/index", name = "index_absence")
     */
    public function indexabsenceAction()
    {
        return $this->render('AbsenceBundle:Default:indexabsence.html.twig');
    }




    /**
     * @Route("/admin/etudiants/list/{modification}/{supression}/{ajout}", defaults={"modification" = 0,"supression" = 0, "ajout" = 0}, name = "list_etudiant")
     */
    public function listetudiantAction($modification, $supression, $ajout)
    {
        if($modification == true){
            return $this->render('AbsenceBundle:Default:listetudiant.html.twig', array('modification' => true, 'supression' => false, 'ajout' => false));
        }
        if($supression == true){
            return $this->render('AbsenceBundle:Default:listetudiant.html.twig', array('modification' => false, 'supression' => true, 'ajout' => false));
        }
        if($ajout == true){
            return $this->render('AbsenceBundle:Default:listetudiant.html.twig', array('modification' => false, 'supression' => false, 'ajout' => true));
        }

            return $this->render('AbsenceBundle:Default:listetudiant.html.twig', array('modification' => false, 'supression' => false, 'ajout' => false));

    }


    /**
     * @Route("/admin/etudiants/list_parclasse", name = "list_etudiant_classe")
     */
    public function listetudiantclasseAction(Request $request)
    {
        $etudiant = new Etudiant();
        $form   = $this->get('form.factory')->create(EtudiantClasseType::class, $etudiant);

        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getClasse()->getId();
            $nom = $data->getClasse()->getNom();
            $session = $request->getSession();
            $session->set('id', $id);
            $session->set('nom', $nom);
            return $this->redirectToRoute('list_etudiant_classe_show');
        }


        return $this->render('AbsenceBundle:Default:listetudiantclasse.html.twig', array('f'=> $form->createView()));
    }


    /**
     * @Route("/admin/etudiants/list_parclasse_show", name = "list_etudiant_classe_show")
     */

    public function listetudiantclasseshowAction(Request $request)
    {
        $session = $request->getSession();
        $id = $session->get('id');
        $nom = $session->get('nom');
        $etudiants = $this->getDoctrine()->getRepository("AbsenceBundle:Etudiant")->findBy(array('classe' => $id));
        return $this->render('AbsenceBundle:Default:listetudiantclasseshow.html.twig', array('etudiants' => $etudiants, 'id' => $id, 'nom' => $nom));
    }


    /**
     * @Route("/admin/etudiants/list_tous", name = "list_etudiant_tous")
     */
    public function listetudianttousAction()
    {
        $etudiants = $this->getDoctrine()->getRepository("AbsenceBundle:Etudiant")->findAll();
        return $this->render('AbsenceBundle:Default:listetudianttous.html.twig', array('etudiants' => $etudiants));
    }




    /**
     * @Route("/classe/list/{modification}/{supression}/{ajout}", defaults={"modification" = 0,"supression" = 0, "ajout" = 0}, name = "list_classe")
     */
    public function listclasseAction($modification, $supression, $ajout)
    {
        if($modification == true){
            $classes = $this->getDoctrine()->getRepository("AbsenceBundle:Classe")->findAll();
            return $this->render('AbsenceBundle:Default:listclasse.html.twig', array('classes' => $classes, 'modification' => true, 'supression' => false, 'ajout' => false));
        }
        if($supression == true){
            $classes = $this->getDoctrine()->getRepository("AbsenceBundle:Classe")->findAll();
            return $this->render('AbsenceBundle:Default:listclasse.html.twig', array('classes' => $classes, 'modification' => false, 'supression' => true, 'ajout' => false));
        }
        if($ajout == true){
            $classes = $this->getDoctrine()->getRepository("AbsenceBundle:Classe")->findAll();
            return $this->render('AbsenceBundle:Default:listclasse.html.twig', array('classes' => $classes, 'modification' => false, 'supression' => false, 'ajout' => true));
        }
            $classes = $this->getDoctrine()->getRepository("AbsenceBundle:Classe")->findAll();
            return $this->render('AbsenceBundle:Default:listclasse.html.twig', array('classes' => $classes, 'modification' => false, 'supression' => false, 'ajout' => false));


    }


    /**
     * @Route("/admin/absence/list/{ajout}", defaults={"ajout" = 0}, name = "list_absence")
     */

    public function listabsenceAction($ajout)
    {
        if($ajout == true){
            return $this->render('AbsenceBundle:Default:listabsence.html.twig', array('ajout' => true));
        }

        return $this->render('AbsenceBundle:Default:listabsence.html.twig', array('ajout' => false));


    }

    /**
     * @Route("/admin/absence/list_paretudiant", name = "list_absence_etudiant")
     */

    public function listabsenceetudiantAction(Request $request)
    {
        $absence = new Absence();
        $form   = $this->get('form.factory')->create(AbsenceEtudiantType::class, $absence);


        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getEtudiant()->getId();
            $nom = $data->getEtudiant()->getNom();
            $session = $request->getSession();
            $session->set('id', $id);
            $session->set('nom', $nom);
            return $this->redirectToRoute('list_absence_etudiant_show');
        }

        return $this->render('AbsenceBundle:Default:listabsenceetudiant.html.twig', array('f'=> $form->createView()));
    }


    /**
     * @Route("/admin/absence/list_paretudiant_show", name = "list_absence_etudiant_show")
     */

    public function listabsenceetudiantshowAction(Request $request)
    {
        $session = $request->getSession();
        $id = $session->get('id');
        $nom = $session->get('nom');
        $absences = $this->getDoctrine()->getRepository("AbsenceBundle:Absence")->findBy(array('etudiant' => $id));
        return $this->render('AbsenceBundle:Default:listabsenceetudiantshow.html.twig', array('absences' => $absences, 'id' => $id, 'nom' => $nom));
    }





    /**
     * @Route("/admin/absence_list_tous", name = "list_absence_tous")
     */

    public function listabsencetousAction()
    {
        $absences = $this->getDoctrine()->getRepository("AbsenceBundle:Absence")->findAll();
        return $this->render('AbsenceBundle:Default:listabsencetous.html.twig', array('absences' => $absences));
    }





    /**
     * @Route("/admin/etudiant/add", name = "add_etudiant")
     */
    public function addetudiantAction(Request $request)
    {
        $etudiant = new Etudiant();
        $form   = $this->get('form.factory')->create(EtudiantType::class, $etudiant);

        $form->handleRequest($request);
        if($form->isValid() && $request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

            return $this->redirectToRoute('list_etudiant', array('ajout' => true));

        }

        return $this->render('AbsenceBundle:Default:addetudiant.html.twig', array('f'=> $form->createView()));
    }

    /**
     * @Route("/admin/classe/add", name = "add_classe")
     */
    public function addclasseAction(Request $request)
    {
        $classe = new Classe();
        $form   = $this->get('form.factory')->create(ClasseType::class, $classe);

        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();

            return $this->redirectToRoute('list_classe', array('ajout' => true));

        }

        return $this->render('AbsenceBundle:Default:addclasse.html.twig', array('f'=> $form->createView()));
    }

    /**
     * @Route("/admin/absence/add", name="add_absence")
     */
    public function manageabsenceAction(Request $request)
    {
        $absence = new Absence();
        $form   = $this->get('form.factory')->create(AbsenceType::class, $absence);

        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }

        if($form->isValid()){
            $classeID = $data->getEtudiant()->getClasse();
            $em = $this->getDoctrine()->getManager();
            $classe = $em->getRepository('AbsenceBundle:Classe')->find($classeID);
            $absence->setClasse($classe);
            $em = $this->getDoctrine()->getManager();
            $em->persist($absence);
            $em->flush();

            return $this->redirectToRoute('list_absence', array('ajout' => true));
        }

        return $this->render('AbsenceBundle:Default:manageabsence.html.twig', array('f'=> $form->createView()));
    }




     /**
     * @Route("/admin/etudiant/edit", name = "edit_etudiant")
     */
    public function editetudiantAction( Request $request)
    {

        $absence = new Absence();
        $form   = $this->get('form.factory')->create(AbsenceEtudiantType::class, $absence);


        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getEtudiant()->getId();
            $session = $request->getSession();
            $session->set('id', $id);
            return $this->redirectToRoute('edit_etudiant_form');
        }

        return $this->render('AbsenceBundle:Default:editetudiant.html.twig', array('f'=> $form->createView()));
    }


    /**
     * @Route("/admin/etudiant/edit/form", name = "edit_etudiant_form")
     */

    public function editetudiantformAction(Request $request)
    {
        $session = $request->getSession();
        $id = $session->get('id');

        $em = $this->getDoctrine()->getManager();

        $etudiant = $em->getRepository('AbsenceBundle:Etudiant')->find($id);




        $form = $this->get('form.factory')->create(EtudiantEditType::class, $etudiant);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('list_etudiant', array('modification' => true));
        }
        return $this->render('AbsenceBundle:Default:editetudiantform.html.twig', array('f'=> $form->createView()));
    }





    /**
     * @Route("/admin/etudiant/delete", name = "delete_etudiant")
     */
    public function etudiantdeleteAction( Request $request)
    {
        $absence = new Absence();
        $form   = $this->get('form.factory')->create(AbsenceEtudiantType::class, $absence);

        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getEtudiant()->getId();
           // $session = $request->getSession();
            //// $session->set('id', $id);
            $em = $this->getDoctrine()->getManager();

            $etudiant = $em->getRepository('AbsenceBundle:Etudiant')->find($id);

            $em->remove($etudiant);
            $em->flush();

            return $this->redirectToRoute('list_etudiant', array('supression' => true));
        }

        return $this->render('AbsenceBundle:Default:deleteetudiant.html.twig', array('f'=> $form->createView()));
    }




    /**
     * @Route("/admin/classe/edit", name = "edit_classe")
     */
    public function editclasseAction( Request $request)
    {

        $etudiant = new Etudiant();
        $form   = $this->get('form.factory')->create(EtudiantClasseType::class, $etudiant);


        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getClasse()->getId();
            $session = $request->getSession();
            $session->set('id', $id);
            return $this->redirectToRoute('edit_classe_form');
        }

        return $this->render('AbsenceBundle:Default:editclasse.html.twig', array('f'=> $form->createView()));
    }


    /**
     * @Route("/admin/classe/edit/form", name = "edit_classe_form")
     */

    public function editclasseformAction(Request $request)
    {
        $session = $request->getSession();
        $id = $session->get('id');

        $em = $this->getDoctrine()->getManager();

        $classe = $em->getRepository('AbsenceBundle:Classe')->find($id);




        $form = $this->get('form.factory')->create(ClasseEditType::class, $classe);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('list_classe', array('modification' => true));
        }
        return $this->render('AbsenceBundle:Default:editclasseform.html.twig', array('f'=> $form->createView()));
    }




    /**
     * @Route("/admin/classe/delete", name = "delete_classe")
     */
    public function classedeleteAction( Request $request)
    {
        $etudiant = new Etudiant();
        $form   = $this->get('form.factory')->create(EtudiantClasseType::class, $etudiant);

        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getClasse()->getId();
            // $session = $request->getSession();
            //// $session->set('id', $id);
            $em = $this->getDoctrine()->getManager();

            $classe = $em->getRepository('AbsenceBundle:Classe')->find($id);

            $em->remove($classe);
            $em->flush();

            return $this->redirectToRoute('list_classe', array('supression' => true));
        }

        return $this->render('AbsenceBundle:Default:deleteclasse.html.twig', array('f'=> $form->createView()));
    }


    /**
     * @Route("/admin/absence/delete", name = "delete_absence")
     */
    public function absencedeleteAction( Request $request)
    {   $absences = $this->getDoctrine()->getRepository("AbsenceBundle:Absence")->findAll();
        return $this->render('AbsenceBundle:Default:deleteabsence.html.twig', array('absences' => $absences));
    }

    /**
     * @Route("/admin/absence/delete/action/{id}", name = "action_delete_absence")
     */
    public function absencedeleteactionAction( Request $request, $id)
    {   $em = $this->getDoctrine()->getManager();
        $absence = $em->find('AbsenceBundle:Absence',$id);

        $em->remove($absence);
        $em->flush();

        $repository = $em->getRepository('AbsenceBundle:Absence') ;
        $absences = $repository->findAll();

        return $this->render('AbsenceBundle:Default:deleteabsence.html.twig', array(
            'absences' => $absences
        ));
    }








    /**
     * @Route("/admin/absence/edit", name = "edit_absence")
     */
    public function editabsenceAction( Request $request)
    {
        $absences = $this->getDoctrine()->getRepository("AbsenceBundle:Absence")->findAll();
        return $this->render('AbsenceBundle:Default:editabsence.html.twig', array('absences' => $absences));

    }


    /**
     * @Route("/admin/absence/edit/{id}", name = "edit_absence_form")
     */

    public function editabsenceformAction(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $absence = $em->getRepository('AbsenceBundle:Absence')->find($id);
            $form = $this->get('form.factory')->create(AbsenceEditFormType::class, $absence);
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($absence);
                $em->flush();

                return $this->redirectToRoute('edit_absence');
            }

            return $this->render('AbsenceBundle:Default:editabsenceform.html.twig', array(
                'f' => $form->createView(),
            ));
        }











    /**
     * @Route("/admin/absence/list-parclasse", name = "list_absence_classe")
     */

    public function listabsenceclasseAction(Request $request)
    {
        $absence = new Absence();
        $form   = $this->get('form.factory')->create(AbsenceParClasseType::class, $absence);


        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getClasse();
            $nom = $data->getClasse()->getNom();
            $session = $request->getSession();
            $session->set('id', $id);
            $session->set('nom', $nom);
            return $this->redirectToRoute('list_absence_classe_show');
        }

        return $this->render('AbsenceBundle:Default:listabsenceclasse.html.twig', array('f'=> $form->createView()));
    }



    /**
     * @Route("/admin/absence/list-parclasse-show", name = "list_absence_classe_show")
     */

    public function listabsenceclasseshowAction(Request $request)
    {
        $session = $request->getSession();
        $id = $session->get('id');
        $nom = $session->get('nom');
        $absences = $this->getDoctrine()->getRepository("AbsenceBundle:Absence")->findBy(array('classe' => $id));
        return $this->render('AbsenceBundle:Default:listabsenceclasseshow.html.twig', array('absences' => $absences, 'id' => $id, 'nom' => $nom));
    }


    /**
     * @Route("/absence/list-parclasse-user", name = "user_list_absence_classe")
     */

    public function listabsenceclasseuserAction(Request $request)
    {
        $absence = new Absence();
        $form   = $this->get('form.factory')->create(AbsenceParClasseType::class, $absence);


        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $data = $form->getData();
        }
        if($form->isValid()){
            $id = $data->getClasse();
            $nom = $data->getClasse()->getNom();
            $session = $request->getSession();
            $session->set('id', $id);
            $session->set('nom', $nom);
            return $this->redirectToRoute('user_list_absence_classe_show');
        }

        return $this->render('AbsenceBundle:Default:listabsenceclasseuser.html.twig', array('f'=> $form->createView()));
    }



    /**
     * @Route("/absence/list-parclasse-show-user", name = "user_list_absence_classe_show")
     */

    public function listabsenceclasseusershowAction(Request $request)
    {
        $session = $request->getSession();
        $id = $session->get('id');
        $nom = $session->get('nom');
        $absences = $this->getDoctrine()->getRepository("AbsenceBundle:Absence")->findBy(array('classe' => $id));
        return $this->render('AbsenceBundle:Default:listabsenceclasseshowuser.html.twig', array('absences' => $absences, 'id' => $id, 'nom' => $nom));
    }
}
