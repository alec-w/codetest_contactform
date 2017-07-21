<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Model for the enquiries table.
 */
class Enquiry
{
    private $id;
    private $name = '';
    private $email = '';
    private $content = '';

    /**
     * Perform the model validation.
     * A name, email and enquiry content are all required.
     * The email must be a valid.
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        // Validate name.
        $metadata->addPropertyConstraint('name', new Assert\NotBlank(array(
            'message' => 'A name is required.'
        )));

        // Validate email.
        $metadata->addPropertyConstraint('email', new Assert\NotBlank(array(
            'message' => 'An email is required.'
        )));
        $metadata->addPropertyConstraint(
            'email',
            new Assert\Email(array(
                'message' => 'The email {{ value }} is not a valid email.',
                'checkMX' => true
            ))
        );

        // Validate content.
        $metadata->addPropertyConstraint('content', new Assert\NotBlank(array(
            'message' => 'The enquiry cannot be left blank.'
        )));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }
}
