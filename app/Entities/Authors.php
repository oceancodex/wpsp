<?php
namespace OCBP\app\Entities;

use Doctrine\ORM\Mapping as ORM;
use OCBPCORE\Base\BaseEntity;

/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.2/reference/association-mapping.html
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