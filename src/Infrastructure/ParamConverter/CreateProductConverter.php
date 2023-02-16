<?php

namespace App\Infrastructure\ParamConverter;

use App\Application\Command\Product\Request\CreateProduct;
use Attribute;
use JsonException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

#[Attribute] class CreateProductConverter implements ParamConverterInterface
{
    public function __construct()
    {
    }

    public function apply(Request $request, ParamConverter $configuration):void
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $createProduct = new CreateProduct($data['name'], $data['image']);
        $request->attributes->set($configuration->getName(), $createProduct);
    }
    public function supports(ParamConverter $configuration):bool
    {
        return $configuration->getClass() === CreateProduct::class;
    }
}
