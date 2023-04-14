<?php
namespace App\Controller;

use App\Entity\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PostConversationController extends AbstractController
{
  public function __invoke(Conversation $conversation): Conversation
  {
    /** @var User $user1 */
    $user1 = $this->getUser1();
    
    $user2 = $conversation->getUser2();
    
    if ($user1 !== $user2) {
      return $conversation;
    } else {
      throw new BadRequestException();
    }
  }
}
