<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @method string getUserIdentifier()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;
		private $passwordConfirmation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

	public function getPasswordConfirmation(): ?string
	{
		return $this->passwordConfirmation;
	}

	public function setPasswordConfirmation(string $passwordConfirmation): self
	{
		$this->passwordConfirmation = $passwordConfirmation;

		return $this;
	}

	public function getRoles()
	{
		return ['ROLE_USER'];
	}

	public function getSalt()
	{
		// TODO: Implement getSalt() method.
	}

	public function eraseCredentials()
	{

	}

	public function __call($name, $arguments)
	{
		// TODO: Implement @method string getUserIdentifier()
	}
}
