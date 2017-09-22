<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of EmployeeType
 *
 * @author User
 */
class EmployeeType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
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
                ->add( 'save' , SubmitType::class,  array( 'label' => ' Save', 'attr' => array( 'class' => 'btn btn-primary', 'style' => 'margin-bottom:15px' )));
    }
    
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults
         (
                [ 'data_class' => 'AppBundle\Entity\Employee' ]
        );
    }
    

}
