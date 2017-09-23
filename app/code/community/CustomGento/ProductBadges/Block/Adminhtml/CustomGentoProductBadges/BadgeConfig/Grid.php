<?php
class CustomGento_ProductBadges_Block_Adminhtml_CustomGentoProductBadges_BadgeConfig_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Initialize grid
     * Set sort settings
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('product_badges_badge_config_grid');
        $this->setDefaultSort('sort_order');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Set collection
     *
     * @return CustomGento_ProductBadges_Block_Adminhtml_CustomGentoProductBadges_BadgeConfig_Grid
     */
    protected function _prepareCollection()
    {
        /** @var $collection CustomGento_ProductBadges_Model_Resource_BadgeConfig_Collection */
        $collection = Mage::getModel('customgento_productbadges/badgeConfig')
            ->getResourceCollection();

        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    /**
     * Add grid columns
     *
     * @return CustomGento_ProductBadges_Block_Adminhtml_CustomGentoProductBadges_BadgeConfig_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('badge_config_id', array(
            'header'    => Mage::helper('customgento_productbadges')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'badge_config_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('customgento_productbadges')->__('Badge Name'),
            'align'     =>'left',
            'index'     => 'name',
        ));

        $this->addColumn('from_date', array(
            'header'    => Mage::helper('customgento_productbadges')->__('Date Start'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'from_date',
        ));

        $this->addColumn('to_date', array(
            'header'    => Mage::helper('customgento_productbadges')->__('Date End'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'to_date',
        ));

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('customgento_productbadges')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'is_active',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));

        parent::_prepareColumns();
        return $this;
    }

    /**
     * Retrieve row click URL
     *
     * @param Varien_Object $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('badge_config_id' => $row->getData('badge_config_id')));
    }

}