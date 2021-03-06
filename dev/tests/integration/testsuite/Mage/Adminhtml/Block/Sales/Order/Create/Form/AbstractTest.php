<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Mage_Adminhtml
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Test class for Mage_Adminhtml_Block_Sales_Order_Create_Form_Abstract
 */
class Mage_Adminhtml_Block_Sales_Order_Create_Form_AbstractTest
    extends PHPUnit_Framework_TestCase
{
    public function testAddAttributesToForm()
    {
        $block = $this->getMockForAbstractClass('Mage_Adminhtml_Block_Sales_Order_Create_Form_Abstract')
            ->setLayout(new Mage_Core_Model_Layout);

        $method = new ReflectionMethod(
            'Mage_Adminhtml_Block_Sales_Order_Create_Form_Abstract', '_addAttributesToForm');
        $method->setAccessible(true);

        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('test_fieldset', array());
        $dateAttribute = new Mage_Customer_Model_Attribute(array(
            'attribute_code' => 'date',
            'backend_type' => 'datetime',
            'frontend_input' => 'date',
            'frontend_label' => 'Date',
        ));
        $attributes = array('date' => $dateAttribute);
        $method->invoke($block, $attributes, $fieldset);

        $element = $form->getElement('date');
        $this->assertNotNull($element);
        $this->assertNotEmpty($element->getDateFormat());
    }
}
