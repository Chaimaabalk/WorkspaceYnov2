<?php

// namespace App\Entity;

// use ApiPlatform\Metadata\ApiResource;
// use App\Repository\PrivateMessageRepository;
// use Doctrine\ORM\Mapping as ORM;
// use ApiPlatform\Metadata\Delete;
// use ApiPlatform\Metadata\GetCollection;
// use Doctrine\DBAL\Types\Types;
// use ApiPlatform\Metadata\Link;
// use ApiPlatform\Metadata\Post;
// use App\Controller\PrivateMessageController;
// use Symfony\Component\Serializer\Annotation\Groups;

// #[ORM\Entity(repositoryClass: PrivateMessageRepository::class)]
// #[ApiResource(
//     operations: [
//         new Post(security: "is_granted('ROLE_USER')", controller: PrivateMessageController::class),
//         new Delete(security: "is_granted('ROLE_ADMIN') or object.getOwner() == user"),
//     ],
//     denormalizationContext: ['groups' => ['privateMessage:write']],
// )]
// #[ApiResource(
//     uriTemplate: '/conversations/{conversation_id}/messages',
//     operations: [new GetCollection(
//         security: "is_granted('ROLE_USER')"
//     )],
//     uriVariables: [
//         'conversation_id' => new Link(toProperty: 'conversation', fromClass: Conversation::class),
//     ],
//     denormalizationContext: ['groups' => ['privateMessage:read']]
// )]
// class PrivateMessage
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column(type: Types::INTEGER)]
//     #[Groups(['privateMessage:read'])]
//     private  $id ;

//     #[ORM\Column(type: Types::TEXT)]
//     #[Groups(['privateMessage:write', 'privateMessage:read'])]
//     private ?string $content = null;

//     #[ORM\ManyToOne(inversedBy: 'privateMessages')]
//     #[ORM\JoinColumn(nullable: false)]
//     #[Groups(['privateMessage:read'])]
//     private ?User $author = null;

//     #[ORM\ManyToOne(inversedBy: 'privateMessages')]
//     #[ORM\JoinColumn(nullable: false)]
//     #[Groups(['privateMessage:write', 'privateMessage:read'])]
//     private ?Conversation $conversation = null;

//     #[ORM\Column]
//     #[Groups(['privateMessage:read'])]
//     private ?\DateTimeImmutable $createdAt = null;

//     public function __construct()
//     {
//         $this->createdAt = new \DateTimeImmutable('now');
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getContent(): ?string
//     {
//         return $this->content;
//     }

//     public function setContent(string $content): self
//     {
//         $this->content = $content;

//         return $this;
//     }

//     public function getAuthor(): ?User
//     {
//         return $this->author;
//     }

//     public function setAuthor(?User $author): self
//     {
//         $this->author = $author;

//         return $this;
//     }

//     public function getConversation(): ?Conversation
//     {
//         return $this->conversation;
//     }

//     public function setConversation(?Conversation $conversation): self
//     {
//         $this->conversation = $conversation;

//         return $this;
//     }

//     public function getCreatedAt(): ?\DateTimeImmutable
//     {
//         return $this->createdAt;
//     }

//     public function setCreatedAt(\DateTimeImmutable $createdAt): self
//     {
//         $this->createdAt = $createdAt;

//         return $this;
//     }
// }