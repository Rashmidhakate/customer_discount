<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

/**
 * Catalog breadcrumbs
 */
namespace Customer\Discount\Block;

use  Magento\Customer\Model\Session;

class Discount extends \Magento\Framework\View\Element\Template
{
    public $customerSession;
   public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ){
        $this->customerSession = $customerSession;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getCustomerSession(){
        return $this->customerSession;
    }

    public function getDiscount(){
        return "hello";
    }
   
}
