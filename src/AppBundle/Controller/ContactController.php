<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Enquiry;
use AppBundle\Form\ContactForm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Get enquiries submitted through the contact form.
 * Add quesries to the database and show the received enquiry back to the user.
 * Send an email to the customer confirming receipt of their enquiry.
 * Send an email to enquiries@example.com notifying that a new enquiry has been submitted.
 */
class ContactController extends Controller
{
    public function indexAction(Request $request)
    {
        // Create empty enquiry.
        $enquiry = new Enquiry();

        // Create contact form and handle request.
        $form = $this->createForm(ContactForm::class, $enquiry, array('submit_message' => 'Send Enquiry'));
        $form->handleRequest($request);

        // If form is submitted and valid then process data.
        if ($form->isSubmitted() && $form->isValid()) {
            $enquiry = $form->getData();

            // Try to insert the enquiry.
            $em = $this->getDoctrine()->getManager();
            $em->persist($enquiry);
            try {
                $em->flush();
            } catch (Doctrine\ORM\ORMException $exception) {
                // Display the submitted enquiry and a message informing it failed to submit.
                return $this->render('contact/submitted.html.twig', array(
                    'enquiry' => $enquiry,
                    'success' => false
                ));
            }

            // Send a confirmation email to the user.

            // Send a notification email to enquiries@example.com

            // Display the submitted enquiry and a message informing it was submitted successfully.
            return $this->render('contact/submitted.html.twig', array(
                'enquiry' => $enquiry,
                'success' => true
            ));
        }

        // Render contact page (with any errors from the form).
        return $this->render('contact/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
