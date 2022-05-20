<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait BlameableTrait
{
    /**
     * @var string|null
     *
     * @Gedmo\Blameable(on="create")
     *  @ORM\ManyToOne(targetEntity="User")
     */
    private $createdBy;

    /**
     * @var string|null
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $updatedBy;

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string|null $createdBy
     * @return self
     */
    public function setCreatedBy(?string $createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string|null $updatedBy
     * @return self
     */
    public function setUpdatedBy(?string $updatedBy): self
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
}