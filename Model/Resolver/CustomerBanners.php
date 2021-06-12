<?php
/**
 * Copyright © Landofcoder All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\PromotionBarGraphQl\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Lof\PromotionBar\Api\BannerRepositoryInterface;
use Magento\GraphQl\Model\Query\ContextInterface;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;
use Magento\Quote\Model\Cart\CustomerCartResolver;
/**
 * Class Banners
 * @package Lof\PromotionBarGraphQl\Model\Resolver
 */
class CustomerBanners implements ResolverInterface
{

    /**
     * @var CustomerCartResolver
     */
    private $customerCartResolver;
    /**
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;

    /**
     * Banners constructor.
     * @param BannerRepositoryInterface $bannerRepository
     * @param CustomerCartResolver $customerCartResolver
     */
    public function __construct(
        BannerRepositoryInterface $bannerRepository,
        CustomerCartResolver $customerCartResolver
    )
    {
        $this->bannerRepository = $bannerRepository;
        $this->customerCartResolver = $customerCartResolver;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $currentUserId = $context->getUserId();
        /**
         * @var ContextInterface $context
         */
        if (false === $context->getExtensionAttributes()->getIsCustomer()) {
            throw new GraphQlAuthorizationException(__('The request is allowed for logged in customer'));
        }

        try {
            $cart = $this->customerCartResolver->resolve($currentUserId);
        } catch (\Exception $e) {
            $cart = null;
        }
        $searchResult = null;
        if($cart){
            $store = $context->getExtensionAttributes()->getStore();
            $searchResult = $this->bannerRepository->getListByCart($cart->getId() , [0, $store->getId()] );
        }

        return [
            'total_count' => $searchResult?$searchResult->getTotalCount():0,
            'items'       => $searchResult?$searchResult->getItems():[],
        ];
    }
}
