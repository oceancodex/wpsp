<?php
namespace WPSP\app\Entities;

use Doctrine\ORM\Mapping as ORM;
use WPSPCORE\Base\BaseEntity;

/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/reference/association-mapping.html
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/reference/basic-mapping.html
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/reference/association-mapping.html
 */

///**
// * @ORM\Entity
// * @ORM\Table(name="authors")
// */
class Authors extends BaseEntity {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected int $id;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected string $name;


	/*
	 *
	 */

	public function setId(int $id): void {
		$this->id = $id;
	}

	public function getId(): int {
		return $this->id;
	}

}