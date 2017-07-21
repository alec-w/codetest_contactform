<?php

namespace AppBundle\Controller;

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
        return $this->render('contact/index.html.twig');
    }
}
