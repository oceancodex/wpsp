<?php
namespace WPSP\app\Entities;

use Doctrine\ORM\Mapping as ORM;
use WPSPCORE\Base\BaseEntity;

/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.2/reference/association-mapping.html
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

	public function setId(int $id): void {
		$this->id = $id;
	}

	public function getId(): int {
		return $this->id;
	}

	public function setKey(string $key): void {
		$this->key = $key;
	}

	public function getKey(): string {
		return $this->key;
	}

	public function setValue(string $value): void {
		$this->value = $value;
	}

	public function getValue(): string {
		return $this->value;
	}

	public function setDescription(string $description): void {
		$this->description = $description;
	}

	public function getDescription(): string {
		return $this->description;
	}

}