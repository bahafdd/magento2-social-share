<?php

namespace Themestar\SocialShare\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DesignVersions implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'version1', 'label' => __('Version 1 (Icon + Text: "Share in ")')],
            ['value' => 'version2', 'label' => __('Version 2 (Text: "share in ")')],
            ['value' => 'version3', 'label' => __('Version 3 (Icon Only)')]
        ];
    }
}
