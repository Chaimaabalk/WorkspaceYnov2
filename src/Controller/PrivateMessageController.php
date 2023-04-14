<?php
namespace App\Controller;

use App\Entity\PrivateMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PrivateMessageController extends AbstractController
{
    public function __invoke(PrivateMessage $privateMessage): PrivateMessage
    {
        $user = $this->getUser();

        $conversation = $privateMessage->getConversation();

        if (!$conversation->getUsers()->contains($user)) {
            throw new AccessDeniedHttpException();
        }

        return $privateMessage;
    }
}
