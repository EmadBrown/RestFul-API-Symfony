<?php

namespace AppBundle\Controller\Web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Employee;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Trash;
 
 

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
         
         $employee= new Employee;
         $form = $this->createFormBuilder($employee)
                 ->add( 'firstName' , TextType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'lastName' , TextType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'email' ,  EmailType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'phone' , NumberType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add('address' , TextType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'startDate' , DateTimeType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'endDate' , DateTimeType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'jobTitle' , TextType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'salary' , MoneyType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'description' , TextareaType::class,  array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                ->add( 'save' , SubmitType::class,  array( 'label' => ' Create Employee', 'attr' => array( 'class' => 'btn btn-primary', 'style' => 'margin-bottom:15px' )))
                 ->getForm();
         
         $form->handleRequest($request);
         
         if($form->isSubmitted()&& $form->isValid())
         {
                // Get New Employee Data
                    $firstName = $form['firstName']->getData();
                    $lastName = $form['lastName']->getData();
                    $email = $form['email']->getData();
                    $phone = $form['phone']->getData();
                    $address = $form['address']->getData();
                    $startDate = $form['startDate']->getData();
                    $endDate = $form['endDate']->getData();
                    $jobTitle = $form['jobTitle']->getData();
                    $salary = $form['salary']->getData();
                    $description = $form['description']->getData();
                    
                    $now = new\DateTime('now');
                    
                    $employee->setFirstName($firstName);
                    $employee->setLastName($lastName);
                    $employee->setEmail($email);
                    $employee->setPhone($phone);
                    $employee->setAddress($address);
                    $employee->setStartDate($startDate);
                    $employee->setEndDate($endDate);
                    $employee->setJobTitle($jobTitle);
                    $employee->setSalary($salary);
                    $employee->setDescription($description);
                    $employee->setCreateDate($now);
                    
                    $em = $this->getDoctrine()->getManager();
                    
                    $em->persist($employee);
                    $em->flush();
                    
                    $this->addFlash(
                            'Notice',
                            'Employee Has Added'
                           
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
             
            $now = new\DateTime('now');
            
            $employee->setFirstName($employee->getFirstName());
            $employee->setLastName($employee->getLastName());
            $employee->setEmail($employee->getEmail());
            $employee->setPhone($employee->getPhone());
            $employee->setAddress($employee->getAddress());
            $employee->setStartDate($employee->getStartDate());
            $employee->setEndDate($employee->getEndDate());
            $employee->setJobTitle($employee->getJobTitle());
            $employee->setSalary($employee->getSalary());
            $employee->setDescription($employee->getDescription());
            $employee->setCreateDate($now);

         $form = $this->createFormBuilder($employee)
                 ->add( 'firstName' , TextType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'lastName' , TextType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'email' ,  EmailType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'phone' , NumberType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add('address' , TextType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'startDate' , DateTimeType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'endDate' , DateTimeType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'jobTitle' , TextType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'salary' , MoneyType::class, array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                 ->add( 'description' , TextareaType::class,  array( 'attr' => array( 'class' => 'form-control', 'style' => 'margin-bottom:15px' )))
                ->add( 'save' , SubmitType::class,  array( 'label' => ' Update Employee', 'attr' => array( 'class' => 'btn btn-primary', 'style' => 'margin-bottom:15px' )))
                 ->getForm();
         
         $form->handleRequest($request);
         
         if($form->isSubmitted()&& $form->isValid())
         {
                // Get New Employee Data
                    $firstName = $form['firstName']->getData();
                    $lastName = $form['lastName']->getData();
                    $email = $form['email']->getData();
                    $phone = $form['phone']->getData();
                    $address = $form['address']->getData();
                    $startDate = $form['startDate']->getData();
                    $endDate = $form['endDate']->getData();
                    $jobTitle = $form['jobTitle']->getData();
                    $salary = $form['salary']->getData();
                    $description = $form['description']->getData();
                    
                    $now = new\DateTime('now');
                    $em = $this->getDoctrine()->getManager();
                    $employee = $em->getRepository('AppBundle:Employees')->find($id);
                    
                    $employee->setFirstName($firstName);
                    $employee->setLastName($lastName);
                    $employee->setEmail($email);
                    $employee->setPhone($phone);
                    $employee->setAddress($address);
                    $employee->setStartDate($startDate);
                    $employee->setEndDate($endDate);
                    $employee->setJobTitle($jobTitle);
                    $employee->setSalary($salary);
                    $employee->setDescription($description);
                    $employee->setCreateDate($now);
                    
                  
                    
                 
                    $em->flush();
                    
                    $this->addFlash(
                            'Notice',
                            ' Employee Has Updated'
                           
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
                            'Employee Has Removed'
                  );
                    
         return $this->redirectToRoute('employee_list');
    }
    
    
 
    
}


