<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /** @var Product $product */
    protected $product;

    /** @var User $user */
    protected $user;

    protected function setUp(): void
    {
        $this->product = new Product();
        $this->user = new User();
        $this->user->setNom("Crepy")
            ->setPrenom('Tanguy')
            ->setEmail('tanguycrepy@gmail.com')
            ->setAge(22);
    }

    public function testIsValid()
    {
        $this->product->setNom('test')
            ->setOwner($this->user);

        $this->assertTrue($this->product->isValid());
    }

    public function testIsUserInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('L\'utilisateur n\'est pas valide');

        $this->user->setNom('');
        $this->product->setNom('test')
            ->setOwner($this->user);
    }

    public function testInvalidNomProduct()
    {
        $this->product->setOwner($this->user);

        $this->assertFalse($this->product->isValid());
    }

    public function testInvalidOwnerProduct()
    {
        $this->product->setNom('test');

        $this->assertFalse($this->product->isValid());
    }

}