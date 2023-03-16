<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AddVoteController extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(Message $message, User $user): Message
    {
        $user = $this->getUser();
        $owner = $message->getOwner();
        if ($user === $owner) {
            throw new AccessDeniedHttpException();
        } else {
            $message->setVote($message->getVote() + 1);
        }
        return $message;
    }
}
