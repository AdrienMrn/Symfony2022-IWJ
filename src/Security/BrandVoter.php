<?php

namespace App\Security;

use App\Entity\Brand;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BrandVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports(string $attribute, $subject): bool
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        if (!$subject instanceof Brand) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Brand $brand */
        $brand = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $user === $brand->getCreatedBy() || in_array('ROLE_SUPER_ADMIN', $user->getRoles());
                break;
        }

        throw new \LogicException('This code should not be reached!');
    }
}