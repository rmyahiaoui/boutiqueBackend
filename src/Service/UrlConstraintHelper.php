<?php
namespace App\Service;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UrlConstraintHelper {

    public function checkUrl(String $url, ValidatorInterface $validator): bool {
        $emailConstraint = new Assert\Url();
        $notBlankConstraint = new Assert\NotBlank();
        $errors = $validator->validate(
            $url,
            [$notBlankConstraint, $emailConstraint]
        );
        return (count($errors)===0);
    }
}