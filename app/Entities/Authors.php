<?php
namespace WPSP\app\Entities;

use Doctrine\ORM\Mapping as ORM;
use WPSPCORE\Base\BaseEntity;

/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/attributes-reference.html
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/basic-mapping.html#basic-mapping
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/association-mapping.html
 */

//#[ORM\Entity]
//#[ORM\Table(name: 'authors')]
class Authors extends BaseEntity {

	#[ORM\Id]
	#[ORM\Column(type: 'integer')]
	#[ORM\GeneratedValue]
	protected int $id;

	#[ORM\Column(type: 'string', nullable: false)]
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