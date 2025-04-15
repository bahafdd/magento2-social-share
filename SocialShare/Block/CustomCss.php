<?php

namespace Themestar\SocialShare\Block;

use Magento\Framework\View\Element\Template;

class CustomCss extends Template
{
    protected $_scopeConfig;
    protected $_moduleManager;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_moduleManager = $moduleManager;
        parent::__construct($context, $data);
    }

    public function getCustomCss()
    {
        // Check if the module is enabled
        $isEnabled = (bool) $this->_scopeConfig->getValue('social_share/general/enable_module', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        if ($isEnabled) {
            return $this->_scopeConfig->getValue('social_share/custom_css_group/custom_css');
        }

        return ''; // Return an empty string if the module is not enabled
    }
}
