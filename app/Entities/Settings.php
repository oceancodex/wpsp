<?php
namespace WPSP\app\Entities;

use Doctrine\ORM\Mapping as ORM;
use WPSPCORE\Base\BaseEntity;

/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/attributes-reference.html
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/basic-mapping.html#basic-mapping
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.5/reference/association-mapping.html
 */

#[ORM\Entity]
#[ORM\Table(name:'settings')]
class Settings extends BaseEntity {

	#[ORM\Id]
	#[ORM\Column(type: 'integer')]
	#[ORM\GeneratedValue]
	protected int $id;

	#[ORM\Column(type: "string", nullable: false)]
	private string $key;

	#[ORM\Column(type: "text", nullable: true)]
	private string $value;

	#[ORM\Column(type: "text", nullable: true)]
	private string $description;

	/*
	 *
	 */

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setKey($key) {
		$this->key = $key;
	}

	public function getKey() {
		return $this->key;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function getValue() {
		return $this->value;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

}