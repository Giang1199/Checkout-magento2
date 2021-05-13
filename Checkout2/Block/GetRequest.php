<?php
declare(strict_types=1);

namespace Dtn\Checkout2\Block;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class GetRequest extends Template
{

    /**
     * @var ShippingInformationInterface
     */
    private $_addressInformation;

    /**
     * @param Context $context
     * @param ShippingInformationInterface $addressInformation
     * @param array $data
     */
    public function __construct(
        Context $context,
        ShippingInformationInterface $addressInformation,
        array $data = []
    )
    {
        $this->_addressInformation = $addressInformation;
        parent::__construct($context, $data);
    }

    /**
     * Get custom Shipping Charge
     *
     * @return String
     */
    public function getRequest()
    {
        $extAttributes = $this->_addressInformation->getExtensionAttributes();
        return $extAttributes->getSpecialRequest(); //get custom attribute data.
    }
}