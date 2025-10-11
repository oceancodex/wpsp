<?php
namespace WPSP\app\Entities;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use WPSPCORE\Base\BaseEntity;

/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/attributes-reference.html
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/basic-mapping.html#basic-mapping
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/association-mapping.html
 */

//#[ORM\Entity]
//#[ORM\Table(name: 'categories')]
class Categories extends BaseEntity {

	#[ORM\Id]
	#[ORM\Column(type: 'integer')]
	#[ORM\GeneratedValue]
	protected int $id;

	#[ORM\Column(type: "string", nullable: false)]
	private string $name;

	#[ORM\Column(type: "text", nullable: true)]
	private string $description;

	#[ORM\ManyToMany(targetEntity: Posts::class, mappedBy: 'categories')]
	private Collection $posts;

	/*
	 *
	 */

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

}