<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Enquiry;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

/**
 * Contact page form - submits enquiries.
 */
class ContactForm extends AbstractType
{
    /**
     * Form configuration.
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Enquiry::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'contact_form',
            'submit_message' => 'Save'
        ));

        return;
    }

    /**
     * Build the form.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('required' => true, 'label' => 'Your name', 'attr' => array('placeholder' => 'Enter your name')))
            ->add('email', EmailType::class, array('required' => true, 'label' => 'Your email address', 'attr' => array('placeholder' => 'Enter your email address')))
            ->add('content', TextareaType::class, array('required' => true, 'attr' => array('rows' => '10'), 'label' => 'Your enquiry', 'attr' => array('placeholder' => 'Enter your enquiry...')))
            ->add('recaptcha', EWZRecaptchaType::class, array('constraints' => array(new RecaptchaTrue()), 'mapped' => false))
            ->add('save', SubmitType::class, array(
                'label' => $options['submit_message'],
                'attr' => array('class' => 'btn-success')
            ));
        
        return;
    }
}
