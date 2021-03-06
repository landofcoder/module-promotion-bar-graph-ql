# Mage2 Module Lof PromotionBarGraphQl

    ``landofcoder/module-promotion-bar-graph-ql``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
magento 2 promotion bar graphql extension

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Lof`
 - Enable the module by running `php bin/magento module:enable Lof_PromotionBarGraphQl
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require landofcoder/module-promotion-bar-graph-ql`
 - enable the module by running `php bin/magento module:enable Lof_PromotionBarGraphQl`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


### Query Examples

1. Query get promotion bars of logged customer shopping cart:

```
{
customerPromotionBarInCart{
  items{
    banner_id
    banner_name
    from_date
    text_content
    text_content_color
    text_content_background_color
    url_color
    bg_image_url
    banner_img
    banner_link
    banner_title
    auto_close_time
    auto_reopen_time
    display_position
    priority
  }
  total_count
}
}
```