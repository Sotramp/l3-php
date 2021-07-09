<?php

namespace App\Entity;

use App\Repository\BetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BetRepository::class)
 */
class Bet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_match;

    /**
     * @ORM\Column(type="integer")
     */
    private $bet_ext;

    /**
     * @ORM\Column(type="integer")
     */
    private $bet_home;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdMatch(): ?int
    {
        return $this->id_match;
    }

    public function setIdMatch(int $id_match): self
    {
        $this->id_match = $id_match;

        return $this;
    }

    public function getBetExt(): ?int
    {
        return $this->bet_ext;
    }

    public function setBetExt(int $bet_ext): self
    {
        $this->bet_ext = $bet_ext;

        return $this;
    }

    public function getBetHome(): ?int
    {
        return $this->bet_home;
    }

    public function setBetHome(int $bet_home): self
    {
        $this->bet_home = $bet_home;

        return $this;
    }
}
