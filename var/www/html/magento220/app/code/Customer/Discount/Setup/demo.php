<?php

namespace Customer\Discount\Setup;

use Magento\Customer\Setup\CustomerSetup;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\AttributeRepository;
use Magento\Eav\Model\Entity\Attribute\SetFactory;

class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;

	public function __construct(
		\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
		SetFactory $attributeSetFactory,
        AttributeRepository $attributeRepository
		)
	{
		$this->customerSetupFactory = $customerSetupFactory;
		$this->attributeSetFactory = $attributeSetFactory;
        $this->attributeRepository = $attributeRepository;
	}

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();

        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(
        	\Magento\Customer\Model\Customer::ENTITY, 
        	'customer_discount', 
        	[
        	'type' => 'varchar',
            'label' => 'Discount Type',
            'input' => 'text',
            'visible' => true
        ]);

		$attribute = $customerSetup->getEavConfig()->getAttribute(
			\Magento\Customer\Model\Customer::ENTITY, 'customer_discount');
        $attribute->setData(
            'used_in_forms',
            ['adminhtml_customer']
        );
        $attribute->save();
		$this->attributeRepository->save($attribute);
        $setup->endSetup();
	}
}
