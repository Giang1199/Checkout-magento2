<?php
declare(strict_types=1);

namespace Dtn\Checkout2\Plugin\Quote;

use Magento\Quote\Model\QuoteRepository;

class SaveToQuote
{
    /**
     * @var QuoteRepository
     */
    protected $quoteRepository;

    /**
     * SaveToQuote constructor.
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(QuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        if (!$extAttributes = $addressInformation->getShippingAddress()->getExtensionAttributes()) {
            return;
        }
        $quote = $this->quoteRepository->getActive($cartId);

        $quote->setData('request', $extAttributes->getSpecialRequest());
    }
}
