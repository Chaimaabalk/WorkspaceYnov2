<?php

// namespace App\Entity;

// use ApiPlatform\Metadata\ApiResource;
// use App\Repository\ConversationRepository;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\ORM\Mapping as ORM;
// use ApiPlatform\Metadata\Delete;
// use ApiPlatform\Metadata\Get;
// use ApiPlatform\Metadata\GetCollection;
// use App\Controller\GetConversationController;
// use ApiPlatform\Metadata\Post;
// use App\Controller\PostConversationController;
// use App\Controller\GetConversationCollectionController;
// use Symfony\Component\Serializer\Annotation\Groups;

// #[ORM\Entity(repositoryClass: ConversationRepository::class)]
// #[ApiResource(
//     security: "is_granted('ROLE_USER')",
//     operations: [
//         new Get(controller: GetConversationController::class),
//         new Post(controller: PostConversationController::class),
//         new GetCollection(controller: GetConversationCollectionController::class),
//         new Delete(security: "is_granted('ROLE_ADMIN') or object.getOwner() == user")
//     ],
//     normalizationContext: ['groups' => ['conversation:read']],
//     denormalizationContext: ['groups' => ['conversation:write']],
// )]
// class Conversation
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column]
//     #[Groups(['conversation:read'])]
//     private ?int $id = null;


//     #[ORM\ManyToOne(targetEntity:User::class)]
//     #[ORM\JoinColumn(nullable:false)]
//     #[Groups(['conversation:read'])]
    
//    private $user1;

   
//    #[ORM\ManyToOne(targetEntity:User::class)]
//    #[ORM\JoinColumn(nullable:false)]
//    #[Groups(['conversation:read', 'conversation:write'])]
    
//    private $user2;

//     #[ORM\Column]
//     #[Groups(['conversation:read'])]
//     private ?\DateTimeImmutable $createdAt = null;

//     #[ORM\OneToMany(mappedBy: 'conversation', targetEntity: PrivateMessage::class, orphanRemoval: true)]
//     #[Groups(['conversation:read'])]
//     private Collection $privateMessages;

//     public function __construct()
//     {
//         $this->createdAt = new \DateTimeImmutable('now');
//         $this->privateMessages = new ArrayCollection();
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getUser1(): ?UserInterface
//     {
//         return $this->user1;
//     }

//     public function setUser1(UserInterface $user1): self
//     {
//         $this->user1 = $user1;

//         return $this;
//     }

//     public function getUser2(): ?UserInterface
//     {
//         return $this->user2;
//     }

//     public function setUser2(UserInterface $user2): self
//     {
//         $this->user2 = $user2;

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

//     /**
//      * @return Collection<int, PrivateMessage>
//      */
//     public function getPrivateMessages(): Collection
//     {
//         return $this->privateMessages;
//     }

//     public function addPrivateMessage(PrivateMessage $privateMessage): self
//     {
//         if (!$this->privateMessages->contains($privateMessage)) {
//             $this->privateMessages->add($privateMessage);
//             $privateMessage->setConversation($this);
//         }

//         return $this;
//     }

//     public function removePrivateMessage(PrivateMessage $privateMessage): self
//     {
//         if ($this->privateMessages->removeElement($privateMessage)) {
//             // set the owning side to null (unless already changed)
//             if ($privateMessage->getConversation() === $this) {
//                 $privateMessage->setConversation(null);
//             }
//         }

//         return $this;
//     }
    
//     public function hasUser(UserInterface $user): bool
//     {
//         return $this->user1 === $user || $this->user2 === $user;
//     }
// }