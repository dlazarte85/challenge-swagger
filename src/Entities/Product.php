<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Product",
 *     type="object",
 *     title="Product",
 *     required={"name", "slug", "description", "price", "stock", "keywords"}
 * )
 * @OA\Property(
 *     property="id",
 *     type="integer",
 *     example=1
 * ),
 * @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Monitor",
 * ),
 * @OA\Property(
 *     property="slug",
 *     type="string",
 *     example="monitor",
 * ),
 * @OA\Property(
 *     property="description",
 *     type="string",
 *     example="Monitor 20' pulgadas",
 * ),
 * @OA\Property(
 *     property="price",
 *     type="string",
 *     example="3899.99",
 * ),
 * @OA\Property(
 *     property="stock",
 *     type="string",
 *     example="34",
 * ),
 * @OA\Property(
 *     property="keywords",
 *     type="string",
 *     example="monitor",
 * ),
 *
 * @ORM\Entity(repositoryClass="ProductRepository")
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="string")
     */
    private $keywords;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of keywords
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set the value of keywords
     *
     * @return self
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Iterate and transform to JSON
     *
     * @return string
     */
    public function toJson(): string
    {
        $json = $this->toArray();

        return json_encode($json);
    }

    /**
     * Iterate and transform to Array
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }
}
