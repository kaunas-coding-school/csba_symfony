<?php

namespace App\Controller;

use App\Manager\CartManager;
use App\Manager\CategoryManager;
use App\Manager\ProductManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\ValidatorException;

class ShopController extends AbstractController
{
    #[Route('/', name: 'shop')]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig');
    }

    #[Route('/category/{name}', name: 'category_products')]
    public function category(string $name, CategoryManager $categoryManager): Response
    {
        $category = $categoryManager->getOneByName($name);
        return $this->render('shop/index.html.twig', ['category' => $category]);
    }

    #[Route('/api/add-to-cart/{ean}', name: 'add_to_cart')]
    public function addToCart(string $ean, CartManager $cartManager, ProductManager $productManager): Response
    {
        $user = $this->getUser();
        $product = $productManager->getByEan($ean);
        if (!$product) {
            throw new ValidatorException("No product with $ean code found");
        }
        $cart = $cartManager->addToCart($product, $user);

        return $this->json(['message' => 'success']);
    }


    #[Route('/api/remove-from-cart/{ean}', name: 'remove_from_cart')]
    public function removeFromCart(string $ean, CartManager $cartManager, ProductManager $productManager): Response
    {
        $user = $this->getUser();
        $product = $productManager->getByEan($ean);
        if (!$product) {
            throw new ValidatorException("No product with $ean code found");
        }
        $cart = $cartManager->removeFromCart($product, $user);

        return $this->json(['message' => 'success']);
    }


}
