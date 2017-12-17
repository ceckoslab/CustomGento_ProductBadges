<?php
class CustomGento_ProductBadges_Block_Renderer_Type_Rectangle
    extends CustomGento_ProductBadges_Block_Renderer_Type_Abstract
        implements CustomGento_ProductBadges_Block_Renderer_Type_Interface
{

    /**
     * @param string $badgeInternalId
     * @param int $productId
     * @return string
     */
    public function getBadgeHtml($badgeInternalId, $productId)
    {
        $badgeConfig = $this->_badgeConfigHelper->getBadgeConfig($badgeInternalId);

        if ($badgeConfig === false) {
            return '';
        }

        $badgeText = $badgeConfig->getBadgeText();

        $badgeText = $this->escapeHtml($badgeText);

        return '<span class="product-badge product-badge--rectangle product-badge--' . $badgeInternalId . '">' . $badgeText . '</span>';
    }

}