<?php


namespace AppBundle\Controller\Web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Trash;
use AppBundle\Entity\Employee;


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
    
    public function listTrashAction()
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
    
    public function  trashDeleteAction($id)
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
    
    
     /**
     * @Route(" /restore/{id}", name="employee_restore")
     */
    
     public function  restoreAction($id)
    {
         
          $restore= new Employee();
          
          $em = $this->getDoctrine()->getManager();
          $employee = $em->getRepository('AppBundle:Trash')->find($id);
          
          
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
            $restore->setid($id);
            $restore->setFirstName($firstName);
            $restore->setLastName($lastName);
            $restore->setEmail($email);
            $restore->setPhone($phone);
            $restore->setAddress($address);
            $restore->setStartDate($startDate);
            $restore->setEndDate($endDate);
            $restore->setJobTitle($jobTitle);
            $restore->setSalary($salary);
            $restore->setDescription($description);
            $restore->setCreateDate($createDate);

          $emRestore = $this->getDoctrine()->getManager();

          $emRestore->persist($restore);
          $emRestore->flush();
         
          $em->remove($employee);
          $em ->flush();
                  
         $this->addFlash(
                            'Notice',
                            'Employee has Restored '
                  );
                    
         return $this->redirectToRoute('employee_trash');
    }
    
    
   
}
