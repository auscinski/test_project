<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    public function testSettingProductName()
    {
        $product = new Product();
        $name = "TV";

        $product->setName($name);

        $this->assertEquals($name, $product->getName());
    }

    public function testSettingInfo()
    {
        $product = new Product();
        $info = "Telewizor kolorowy";

        $product->setInfo($info);

        $this->assertEquals($info, $product->getInfo());
    }


    public function testReturnsProductFullInfo()
    {
        $product = new Product();
        $product->setName("TV");
        $product->setInfo("Telewizor kolorowy");

        $fullName = $product->getName().' - '.$product->getInfo();

        $this->assertSame($fullName, $product->getProductFullName());
    }
}