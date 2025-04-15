<?php

namespace Themestar\SocialShare\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class TwitterCardTypes implements ArrayInterface
{
    /**
     * Provide available options for Twitter Card Types
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'summary', 'label' => __('Summary')],
            ['value' => 'summary_large_image', 'label' => __('Summary Large Image')],
            ['value' => 'app', 'label' => __('App')],
            ['value' => 'player', 'label' => __('Player')],
        ];
    }
}
