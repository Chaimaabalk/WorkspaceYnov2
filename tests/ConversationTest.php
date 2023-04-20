<?php 
// namespace App\Tests;

// use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
// use App\Entity\Conversation;
// use App\Entity\User;
// use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

// class ConversationTest extends ApiTestCase
// {
//     use ReloadDatabaseTrait;

//     public function testPostConversation()
//     {
//         $client = self::createClient();

//         // Create user1
//         $user1 = new User();
//         $user1->setNickname('chaimaa');
//         $user1->setEmail('chaimaa@example.com');
//         $user1->setPassword('test');
//         $entityManager = $this->getEntityManager();
//         $entityManager->persist($user1);
//         $entityManager->flush();

//         // Create user2
//         $user2 = new User();
//         $user2->setNickname('test');
//         $user2->setEmail('test@example.com');
//         $user2->setPassword('testuser2');
//         $entityManager->persist($user2);
//         $entityManager->flush();

//         // Authenticate user1
//         $response = $client->request('POST', '/api/login_check', [
//             'json' => [
//                 'email' => 'chaimaa@example.com',
//                 'password' => 'test',
//             ],
//         ]);
//         $this->assertResponseIsSuccessful();
//         $data = json_decode($response->getContent(), true);
//         $client->setDefaultOptions([
//             'headers' => [
//                 'Authorization' => 'Bearer ' . $data['token'],
//             ],
//         ]);

//         // Create conversation
//         $conversationData = [
//             'user2' => '/api/users/' . $user2->getId(),
//         ];
//         $client->request('POST', '/api/conversations', [
//             'json' => $conversationData,
//         ]);

//         $this->assertResponseStatusCodeSame(201);

//         $conversation = $entityManager->getRepository(Conversation::class)->findOneBy($conversationData);
//         $this->assertInstanceOf(Conversation::class, $conversation);
//     }

//     private function getEntityManager()
//     {
//         return $this->getService('doctrine')->getManager();
//     }
// }

