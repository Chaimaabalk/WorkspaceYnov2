<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetConversationCollectionController extends AbstractController
{
    public function __invoke(): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Vérifier que l'utilisateur est authentifié
        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette ressource.');
        }

        // Récupérer les conversations créées ou invitées par l'utilisateur
        $conversations = array_merge($user->getCreatedConversations()->toArray(), $user->getInvitedConversations()->toArray());

        // Retourner la collection de conversations en tant que réponse JSON
        return $this->json($conversations, Response::HTTP_OK, [], ['groups' => 'conversation_read']);
    }
}
