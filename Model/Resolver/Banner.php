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

/**
 * Class Banner
 * @package Lof\PromotionBarGraphQl\Model\Resolver
 */
class Banner implements ResolverInterface
{

    /**
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;


    /**
     * Banner constructor.
     * @param BannerRepositoryInterface $bannerRepository
     */
    public function __construct(
        BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
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
        return $this->bannerRepository->getById($args['banner_id']);
    }
}
