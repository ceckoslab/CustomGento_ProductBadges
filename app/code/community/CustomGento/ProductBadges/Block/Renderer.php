<?php
class CustomGento_ProductBadges_Block_Renderer
    extends Mage_Core_Block_Abstract
{

    /** @var CustomGento_ProductBadges_Block_Renderer_Container */
    private $_containerRendererBlock;

    /** @var CustomGento_ProductBadges_Model_Config_RenderTypeData */
    private $_badgeConfigHelper;

    /** @var CustomGento_ProductBadges_Helper_Cache */
    private $_badgeCacheHelper;

    /** @var array */
    private $_badges = array();

    /** @var int */
    private $_productId;

    protected function _construct()
    {
        $this->_containerRendererBlock = Mage::getBlockSingleton('customgento_productbadges/renderer_container');
        $this->_badgeConfigHelper      = Mage::getSingleton('customgento_productbadges/config_renderTypeData');
        $this->_badgeCacheHelper       = Mage::helper('customgento_productbadges/cache');
    }

    /**
     * @param array $badges
     * @param $productId
     */
    public function init(array $badges, $productId)
    {
        $this->_badges = $badges;
        $this->_productId = $productId;
        $this->setCacheKey($this->_badgeCacheHelper->getProductBadgesCacheKey($this->_productId));
    }

    /**
     * @return int
     */
    public function getCacheLifetime()
    {
        return 3600;
    }

    /**
     * @param array $badges
     * @param $productId
     *
     * @return string
     */
    public function generateBadgesHtml(array $badges, $productId)
    {
        if (empty($badges)) {
            return '';
        }

        foreach ($badges as $badgeCode => $value) {
            $badgeConfig = $this->_badgeConfigHelper->getBadgeConfig($badgeCode);

            $this->_containerRendererBlock->attachBadgeToContainer($badgeCode, $badgeConfig);
        }

        $badgesHtml = $this->_containerRendererBlock->generateContainersHtml($productId);
        $this->_containerRendererBlock->clearState();

        return $badgesHtml;
    }

    /**
     * Override this method in descendants to produce html
     *
     * @return string
     */
    protected function _toHtml()
    {
        $this->_addCacheTags();

        if (!empty($this->_badges) && !empty($this->_productId)) {
            return $this->generateBadgesHtml($this->_badges, $this->_productId);
        }

        return '';
    }

    protected function _addCacheTags()
    {
        $this->addCacheTag(
            $this->_badgeCacheHelper->getProductBadgesTags(array_keys($this->_badges))
        );
    }

}