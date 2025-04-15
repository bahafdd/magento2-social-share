<?php
namespace Themestar\SocialShare\Block;

use Magento\Framework\View\Element\Template;

class SocialShare extends Template
{
    protected $_scopeConfig;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function isEnabled()
    {
        return $this->_scopeConfig->getValue('social_share/general/enable_module', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    // Get the selected design version from system configuration
    public function getFacebookDesignVersion()
    {
        return $this->_scopeConfig->getValue('social_share/facebook_group/design_version', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    // Get the selected design version from system configuration
    public function getTwitterDesignVersion()
    {
        return $this->_scopeConfig->getValue('social_share/twitter_group/twitter_design', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    // Get the selected design version for Reddit from system configuration
    public function getRedditDesignVersion()
    {
        return $this->_scopeConfig->getValue('social_share/reddit_group/reddit_design', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    // Get the selected design version for LinkedIn from system configuration
    public function getLinkedInDesignVersion()
    {
        return $this->_scopeConfig->getValue('social_share/linkedin_group/linkedin_design', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    // Get the selected design version for Pinterest from system configuration
    public function getPinterestDesignVersion()
    {
        return $this->_scopeConfig->getValue('social_share/pinterest_group/pinterest_design', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    // Get the selected design version for WhatsApp from system configuration
    public function getWhatsAppDesignVersion()
    {
        return $this->_scopeConfig->getValue('social_share/whatsapp_group/whatsapp_design', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    
    

    public function getFacebookSettings()
    {
        return [
            'enabled' => $this->_scopeConfig->getValue('social_share/facebook_group/facebook', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'icon_color' => $this->_scopeConfig->getValue('social_share/facebook_group/facebook_icon_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'bg_color' => $this->_scopeConfig->getValue('social_share/facebook_group/facebook_bg_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
        ];
    }

    public function getTwitterSettings()
    {
        return [
            'enabled' => $this->_scopeConfig->getValue('social_share/twitter_group/twitter', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'icon_color' => $this->_scopeConfig->getValue('social_share/twitter_group/twitter_icon_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'bg_color' => $this->_scopeConfig->getValue('social_share/twitter_group/twitter_bg_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
        ];
    }

    public function getLinkedInSettings()
    {
        return [
            'enabled' => $this->_scopeConfig->getValue('social_share/linkedin_group/linkedin', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'icon_color' => $this->_scopeConfig->getValue('social_share/linkedin_group/linkedin_icon_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'bg_color' => $this->_scopeConfig->getValue('social_share/linkedin_group/linkedin_bg_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
        ];
    }


    public function getWhatsappSettings()
    {
        return [
            'enabled' => $this->_scopeConfig->getValue('social_share/whatsapp_group/whatsapp', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'icon_color' => $this->_scopeConfig->getValue('social_share/whatsapp_group/whatsapp_icon_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'bg_color' => $this->_scopeConfig->getValue('social_share/whatsapp_group/whatsapp_bg_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
        ];
    }

    public function getPinterestSettings()
    {
        return [
            'enabled' => $this->_scopeConfig->getValue('social_share/pinterest_group/pinterest', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'icon_color' => $this->_scopeConfig->getValue('social_share/pinterest_group/pinterest_icon_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'bg_color' => $this->_scopeConfig->getValue('social_share/pinterest_group/pinterest_bg_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
        ];
    }

    public function getRedditSettings()
    {
        return [
            'enabled' => $this->_scopeConfig->getValue('social_share/reddit_group/reddit', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'icon_color' => $this->_scopeConfig->getValue('social_share/reddit_group/reddit_icon_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'bg_color' => $this->_scopeConfig->getValue('social_share/reddit_group/reddit_bg_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
        ];
    }

   


  
    public function getSocialShareIcons()
    {
        $icons = [];

        foreach (['Facebook', 'Twitter', 'LinkedIn', 'YouTube', 'Instagram', 'WhatsApp', 'Pinterest', 'Reddit', 'Tumblr', 'TikTok', 'VK', 'Snapchat', 'Flickr', 'Quora', 'Vimeo', 'Foursquare', 'Digg', 'Mix', 'Behance', 'Dribbble', 'GitHub'] as $platform) {
            $method = 'get' . $platform . 'Settings';
            if ($this->$method()['enabled']) {
                $icons[] = [
                    'platform' => $platform,
                    'icon_color' => $this->$method()['icon_color'],
                    'bg_color' => $this->$method()['bg_color'],
                ];
            }
        }

        return $icons;
    }
}
