<?php


namespace AppBundle\Controller\Web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Trash;


/**
 * Description of RemoveEmployeeController
 *
 * @author User
 */
class TrashController  extends Controller
{
      
        /**
     * @Route("/trash", name="employee_trash")
     */
    
    public function listAction()
    {
        $trashEmployee = $this->getDoctrine()
                    ->getRepository('AppBundle:Trash')
                    ->findAll();
        
        return $this->render('employee/trash.html.twig', array(
            'employees' => $trashEmployee
        ));
    }
    
    
     /**
     * @Route("/trashDelete/{id}", name="employee_trash_delete")
     */
    
    public function  deleteAction($id)
    {

          $em = $this->getDoctrine()->getManager();
          $trashEmployee = $em->getRepository('AppBundle:Trash')->find($id);
         
          $em->remove($trashEmployee);
          $em ->flush();
                  
         $this->addFlash(
                            'Notice',
                            'Employee has  removed from Trash'
                  );
                    
         return $this->redirectToRoute('employee_trash');
    }
    
    
   
}
