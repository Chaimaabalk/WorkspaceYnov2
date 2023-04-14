<?php
namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Conversation;
use App\Entity\PrivateMessage;

class PrivateMessageTest extends ApiTestCase
{
    public function testAddPrivateMessageToConversation()
    {
        $client = static::createClient();
        $client->disableReboot();
        $client->request('POST', '/api/users', ['json' => [
            'nickname' => 'test2',
            'email' => 'test2@example.com',
            'plainPassword' => 'test',
        ]]);

        $response = $client->request('POST', '/auth', ['json' => [
            'email' => 'test2@example.com',
            'password' => 'test',
        ]]);
        $this->assertResponseIsSuccessful();

        $data = $response->toArray();
        $token = $data['token'];
        $client->setDefaultOptions(['headers' => ['authorization' => 'Bearer ' . $token]]);

        $conversation = new Conversation();
        $conversation->setUser2('/api/users/1');

        $client->request('POST', '/api/conversations', ['json' => [
            'user2' => '/api/users/1',
        ]]);

        $this->assertResponseStatusCodeSame(201);

        $conversationIri = $client->getResponse()->toArray()['@id'];

        $client->request('POST', '/api/private_messages', ['json' => [
            'conversation' => $conversationIri,
            'content' => 'test message',
        ]]);

        $this->assertResponseStatusCodeSame(201);
    }

    public function testAddPrivateMessageToNonExistingConversation()
    {
        $client = static::createClient();
        $client->disableReboot();
        $client->request('POST', '/api/users', ['json' => [
            'nickname' => 'test2',
            'email' => 'test2@example.com',
            'plainPassword' => 'test',
        ]]);

        $response = $client->request('POST', '/auth', ['json' => [
            'email' => 'test2@example.com',
            'password' => 'test',
        ]]);
        $this->assertResponseIsSuccessful();

        $data = $response->toArray();
        $token = $data['token'];
        $client->setDefaultOptions(['headers' => ['authorization' => 'Bearer ' . $token]]);

        $conversation = new Conversation();
        $conversation->setUser2('/api/users/2');

        $client->request('POST', '/api/private_messages', ['json' => [
            'conversation' => '/api/conversations/1000', // Conversation IRI does not exist
            'content' => 'test message',
        ]]);

        $this->assertResponseStatusCodeSame(404);

        $client->request('POST', '/api/private_messages', ['json' => [
            'conversation' => '/api/conversations/1', // Conversation IRI exists but user is not a part of it
            'content' => 'test message',
        ]]);

        $this->assertResponseStatusCodeSame(403);
    }
}
