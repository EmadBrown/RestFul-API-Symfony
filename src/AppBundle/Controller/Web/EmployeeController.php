<?php

namespace AppBundle\Controller\Web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Employee;
 
 
 

class EmployeeController extends Controller
{
    /**
     * @Route("/", name="employee_list")
     */
    
 
    public function listAction()
    {
        $employees = $this->getDoctrine()
                    ->getRepository('AppBundle:Employee')
                    ->findAll();
        
        return $this->render('employee/index.html.twig', array(
            'employees' => $employees
        ));
    }
    
}
