<?php

namespace Themestar\SocialShare\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Page\Config as PageConfig;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Module\Manager as ModuleManager;

class AddSocialMetaTags implements ObserverInterface
{
    protected $pageConfig;
    protected $urlBuilder;
    protected $registry;
    protected $scopeConfig;
    protected $moduleManager;

    public function __construct(
        PageConfig $pageConfig,
        UrlInterface $urlBuilder,
        \Magento\Framework\Registry $registry,
        ScopeConfigInterface $scopeConfig,
        ModuleManager $moduleManager
    ) {
        $this->pageConfig = $pageConfig;
        $this->urlBuilder = $urlBuilder;
        $this->registry = $registry;
        $this->scopeConfig = $scopeConfig;
        $this->moduleManager = $moduleManager;
    }

    public function execute(Observer $observer)
    {
        // Check if the module is enabled in the configuration
        $isEnabled = (bool) $this->scopeConfig->getValue('social_share/general/enable_module', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        if (!$isEnabled) {
            return $this; // Exit if the module is disabled
        }

        // Get the full URL for the current page
        $currentUrl = $this->urlBuilder->getCurrentUrl();

        // Initialize dynamic meta values
        $pageTitle = $this->pageConfig->getTitle()->get();
        $pageDescription = $this->pageConfig->getDescription();
        $imageUrl = ''; // Placeholder for image URLs
        $productPrice = '';
        $currencyCode = $this->scopeConfig->getValue('currency/options/base'); // Get the base currency code

        // Determine if it's a CMS, category, or product page
        if ($currentProduct = $this->registry->registry('current_product')) {
            // Product page
            $imageUrl = $currentProduct->getImageUrl() ?: ''; // Fetch product image URL dynamically
            $pageTitle = $currentProduct->getName();
            $pageDescription = $currentProduct->getMetaDescription() ?: $currentProduct->getShortDescription();
            $productPrice = $currentProduct->getFinalPrice(); // Get the product price
        } elseif ($currentCategory = $this->registry->registry('current_category')) {
            // Category page
            $imageUrl = $currentCategory->getImageUrl() ?: ''; // Adjust if category images are set
            $pageTitle = $currentCategory->getName();
            $pageDescription = $currentCategory->getDescription();
        } elseif ($cmsPage = $this->registry->registry('cms_page')) {
            // CMS page
            $imageUrl = ''; // Optionally set a default image for CMS pages
            $pageTitle = $cmsPage->getTitle();
            $pageDescription = $cmsPage->getMetaDescription();
        }

        // Fetch system configuration values for Facebook OG and Twitter Card
        $fbOgEnabled = (bool) $this->scopeConfig->getValue('social_share/facebook_group/fb_og_enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $twitterCardEnabled = (bool) $this->scopeConfig->getValue('social_share/twitter_group/twitter_card_enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $twitterCardType = $this->scopeConfig->getValue('social_share/twitter_group/twitter_card_type', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        // If Twitter Card is enabled, add Twitter card meta tags
        if ($twitterCardEnabled) {
            $this->pageConfig->addRemotePageAsset('', 'link_rel', ['rel' => 'canonical', 'href' => $currentUrl]);
            $this->pageConfig->setMetadata('twitter:card', $twitterCardType);
            $this->pageConfig->setMetadata('twitter:title', $pageTitle);
            $this->pageConfig->setMetadata('twitter:description', $pageDescription);
            $this->pageConfig->setMetadata('twitter:image', $imageUrl);
        }

        // If Facebook OG is enabled, add Facebook OG meta tags
        if ($fbOgEnabled) {
            // Determine OG type dynamically
            $ogType = $currentProduct ? 'product' : 'website';

            $this->pageConfig->setMetadata('og:type', $ogType);
            $this->pageConfig->setMetadata('og:title', $pageTitle);
            $this->pageConfig->setMetadata('og:description', $pageDescription);
            $this->pageConfig->setMetadata('og:url', $currentUrl);
            $this->pageConfig->setMetadata('og:image', $imageUrl);

            // Add product-specific meta tags if on a product page
            if ($currentProduct) {
                $this->pageConfig->setMetadata('product:price:amount', $productPrice);
                $this->pageConfig->setMetadata('product:price:currency', $currencyCode);
            }
        }

        return $this;
    }
}
