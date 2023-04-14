<?php

namespace App\Controller;

use App\Entity\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GetConversationController extends AbstractController
{
    public function __invoke(Conversation $conversation): Conversation
    {
        $user1 = $conversation->getUser1();
        $user2 = $conversation->getUser2();
        
        $currentUser = $this->getUser();
        
        if ($currentUser !== $user1 && $currentUser !== $user2) {
            throw new AccessDeniedHttpException();
        }
        
        return $conversation;
    }
}