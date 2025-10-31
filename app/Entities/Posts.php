<?php
namespace WPSP\app\Entities;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use WPSPCORE\Base\BaseEntity;

/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/reference/association-mapping.html
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/reference/basic-mapping.html
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/reference/association-mapping.html
 */

///**
// * @ORM\Entity
// * @ORM\Table(name="posts")
// */
class Posts extends BaseEntity {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected int $id;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	private string $title;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private string $excerpt;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private string $content;

	/**
	 * @ORM\ManyToOne(targetEntity="Authors")
	 * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
	 */
	private ?Authors $author = null;

	/**
	 * @ORM\ManyToMany(targetEntity="Categories", inversedBy="posts")
	 * @ORM\JoinTable(name="post_category_relationships",
	 *  joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
	 *  inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
	 * )
	 */
	private Collection $categories;

	/*
	 *
	 */

	public function setId(int $id): void {
		$this->id = $id;
	}

	public function getId(): int {
		return $this->id;
	}

	public function setTitle(string $title): void {
		$this->title = $title;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function setExcerpt(string $excerpt): void {
		$this->excerpt = $excerpt;
	}

	public function getExcerpt(): string {
		return $this->excerpt;
	}

	public function setContent(string $content): void {
		$this->content = $content;
	}

	public function getContent(): string {
		return $this->content;
	}

}