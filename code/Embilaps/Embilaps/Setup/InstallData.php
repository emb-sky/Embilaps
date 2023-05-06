<?php

namespace Embilaps\Embilaps\Setup; 

use Magento\Customer\Model\Customer; 
use Magento\Customer\Setup\CustomerSetup; 
use Magento\Customer\Setup\CustomerSetupFactory; 
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface; 
use Magento\Eav\Model\Entity\Attribute\Source\Boolean; 
use Magento\Framework\Setup\InstallDataInterface; 
use Magento\Framework\Setup\ModuleContextInterface; 
use Magento\Framework\Setup\ModuleDataSetupInterface; 
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Config;

class InstallData implements InstallDataInterface
{ 
    private $eavSetupFactory;
    public function __construct(EavSetupFactory $eavSetupFactory,Config $eavConfig)
    {
        $this->eavSetupFactory=$eavSetupFactory;
        $this->eavConfig=$eavConfig;
    }
    public function install(ModuleDataSetupInterface $setup,ModuleContextInterface $context)
    {
        $eavSetup=$this->eavSetupFactory->create(['setup'=>$setup]);
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'cust_cod_enable',
            [
            'label' => 'Customer COD Enable', 
            'input' => 'boolean', 
            'type' => 'int', 
            'source' => Boolean::class, 
            'required' => false, 
            'default' => '0', 
            'visible' => true, 
            'user_defined' => true, 
            'sort_order' => 999, 
            'position' => 999, 
            'system' => 0, 
            'is_used_in_grid' => true, 
            'is_visible_in_grid' => true, 
            'is_filterable_in_grid' => true, 
            'is_searchable_in_grid' => true, 
            'is_used_for_customer_segment' => true, 
            'is_visible' => true, 
            'is_html_allowed_on_front' => true, 
            'is_filterable' => true, 
            'is_searchable' => true, 
            'is_visible_on_front' => true, 
            'backend' => '', 
            'frontend' => '', 
            'option' => [], 
            'validate_rules' => '' 
            ]
            );


        $custCodEnable=$this->eavConfig->getAttribute(Customer::ENTITY,'cust_cod_enable');
        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);
        
        $custCodEnable->setData('attribute_set_id', $attributeSetId);
        $custCodEnable->setData('attribute_group_id', $attributeGroupId);
            $custCodEnable->setData(
                'used_in_forms',
                ['adminhtml_customer']
            );
            $custCodEnable->save();
    }


}