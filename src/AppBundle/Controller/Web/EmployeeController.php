<?php

namespace AppBundle\Controller\Web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Trash;
use AppBundle\Form\Type\EmployeeType;
 
 

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
    
     /**
     * @Route("/create", name="employee_create")
     */
    
     public function createAction(Request $request)
    {

         $form = $this->createForm(EmployeeType::class ) ;

         $form->handleRequest($request);
         
         if($form->isSubmitted()&& $form->isValid())
         {
                // Get New Employee Data
                    $now = new\DateTime('now');
                    $em = $this->getDoctrine()->getManager();
                    $employee = $form->getData();
                    $employee->setCreateDate($now);
                    $em->persist($employee);
                    $em->flush();
                    
                    $this->addFlash(
                            'Notice',
                            'The New Employee '. $employee->getFirstName() .' ' . $employee->getLastName().  ' has been  Added!'    
                    );
                    
                    return $this->redirectToRoute('employee_list');
         }
                 
                 return $this->render('employee/create.html.twig', array(
                            'form'  =>$form->createView()
                 ));
    }
    
    
    
    
     /**
     * @Route("/edit/{id}", name="employee_edit")
     */
    
     public function editAction($id, Request $request)
    {
        $employee =  $this->getDoctrine()
                    ->getRepository('AppBundle:Employee')
                    ->find($id); 

         $form = $this->createForm(EmployeeType::class,$employee);
         
         $form->handleRequest($request);
         
         if($form->isSubmitted()&& $form->isValid())
         {
                // Get New Employee Data

                    $em = $this->getDoctrine()->getManager();
                    $em->flush();
                    $this->addFlash(
                            'Notice',
                            ' The Employee '. $employee->getFirstName() .' ' . $employee->getLastName(). 'has  been Updated!'    
                    );
                    
                    return $this->redirectToRoute('employee_list');
         }
        
        return $this->render('employee/edit.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView()
        ));
    }
    
    
     /**
     * @Route(" /details/{id}", name="employee_details")
     */
     public function  detailsAction($id)
    {
          $employee =  $this->getDoctrine()
                    ->getRepository('AppBundle:Employee')
                    ->find($id);
        
        return $this->render('employee/details.html.twig', array(
            'employee' => $employee
        ));
    }
    
    
     /**
     * @Route(" /delete/{id}", name="employee_delete")
     */
     public function  deleteAction($id)
    {
         
          $remove = new Trash();
          
          $em = $this->getDoctrine()->getManager();
          $employee = $em->getRepository('AppBundle:Employee')->find($id);
          
          
        // Get New Employee Data
            $firstName = $employee->getFirstName();
            $lastName =  $employee->getLastName();
            $email =  $employee->getEmail();
            $phone =  $employee->getPhone();
            $address =  $employee->getAddress();
            $startDate =  $employee->getStartDate();
            $endDate =  $employee->getEndDate();
            $jobTitle =  $employee->getJobTitle();
            $salary =  $employee->getSalary();
            $description =  $employee->getDescription();
            $createDate =  $employee->getCreateDate();
                    
          
         // Insert data in Trash
            $remove->setid($id);
            $remove->setFirstName($firstName);
            $remove->setLastName($lastName);
            $remove->setEmail($email);
            $remove->setPhone($phone);
            $remove->setAddress($address);
            $remove->setStartDate($startDate);
            $remove->setEndDate($endDate);
            $remove->setJobTitle($jobTitle);
            $remove->setSalary($salary);
            $remove->setDescription($description);
            $remove->setCreateDate($createDate);

          $emRemove = $this->getDoctrine()->getManager();

          $emRemove->persist($remove);
          $emRemove->flush();
         
          $em->remove($employee);
          $em ->flush();
                  
         $this->addFlash(
                            'Notice',
                            'The New Employee '. $employee->getFirstName() .' ' . $employee->getLastName().  ' has been  Removed!'    
                    );
                    
         return $this->redirectToRoute('employee_list');
    }
    
    
 
    
}


