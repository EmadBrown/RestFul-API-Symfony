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
        $remove = $this->getDoctrine()
                    ->getRepository('AppBundle:Trash')
                    ->findAll();
        
        return $this->render('employee/trash.html.twig', array(
            'removes' => $remove
        ));
    }
    
    
    
 
}
