<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @param int $id
     * @return Response
     */
    public function showProductJsonAction($id)
    {
        $serializer = $this->container->get('serializer');
        $serialized = $serializer->serialize($this->container->get('product_manager')->getProductDB($id), 'json');
        $response = new Response($serialized);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return Response
     */
    public function showAllProductsJsonAction()
    {
        $pm = $this->container->get('product_manager');
        $allProducts = $pm->getAllProductsDB();

        $serializer = $this->container->get('serializer');
        $serialized = $serializer->serialize($allProducts, 'json');

        $response = new Response($serialized);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return Response
     */
    public function showAllProductsSortedJsonAction()
    {
        $pm = $this->container->get('product_manager');
        $allProducts = $pm->getAllProductsSorted();

        $serializer = $this->container->get('serializer');
        $serialized = $serializer->serialize($allProducts, 'json');

        $response = new Response($serialized);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return Response
     */
    public function showAllProductsDiscountedJsonAction()
    {
        $pm = $this->container->get('product_manager');
        $allProducts = $pm->getAllProductsDB();

        /**
         * @var Product $entity
         */
        foreach ($allProducts as $entity) {
            $pm->applyPromotion($entity);
        }

        $serializer = $this->container->get('serializer');
        $serialized = $serializer->serialize($allProducts, 'json');

        $response = new Response($serialized);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createProductJsonAction(Request $request)
    {
        $serializer = $this->container->get('serializer');
        $product = $serializer->deserialize($request->getContent(), 'AppBundle\Entity\Product', 'json');

        $pm = $this->container->get('product_manager');
        $pm->createProductDB($product);

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function editProductJsonAction(Request $request)
    {
        $serializer = $this->container->get('serializer');
        $updatedProduct = $serializer->deserialize($request->getContent(), 'AppBundle\Entity\Product', 'json');

        $this->container->get('product_manager')->editProductDB($updatedProduct);

        return new Response();
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteProductJsonAction(Request $id)
    {
        $serializer = $this->container->get('serializer');
        $deletedProduct = $serializer->deserialize($id->getContent(), 'AppBundle\Entity\Product', 'json');

        $this->container->get('product_manager')->deleteProductDB($deletedProduct);

        return new Response();
    }

    /**
     * @return Response
     */
    public function getAllProductsFilteredJsonAction()
    {
        $pm = $this->container->get('product_manager');
        $allFilteredProductsArrays = $pm->getAllProductsFiltered();

        $serializer = $this->container->get('serializer');
        $serialized = $serializer->serialize($allFilteredProductsArrays, 'json');

        $response = new Response($serialized.'asdf');
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
