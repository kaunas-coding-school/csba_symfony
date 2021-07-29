<?php

namespace App\Tests\Unit;

use App\Entity\Category;
use App\Manager\CategoryManager;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CategoryManagerTest extends TestCase
{
    private CategoryManager $categoryManager;
    private MockObject $em;

    public function setUp(): void
    {
        parent::setUp();

        $this->em = $this->createMock(EntityManagerInterface::class);

        $this->categoryManager = new CategoryManager($this->em);
    }

    #[NoReturn]
    public function testGetsCategoryByName(): void
    {
        $categoryName = 'Bandymas';
        $category = new Category();
        $category->setName($categoryName);

        $repository = $this->createMock(CategoryRepository::class);
        $this->em->method('getRepository')->with(Category::class)->willReturn($repository);
        $repository->method('findOneBy')->willReturn($category);

        $category = $this->categoryManager->getOneByName($categoryName);

        $this->assertSame($categoryName, $category->getName());
    }
}
