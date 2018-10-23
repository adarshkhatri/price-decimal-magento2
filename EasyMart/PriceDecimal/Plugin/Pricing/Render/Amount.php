<?php
/**
 *
 * @package EasyMart\PriceDecimal
 *
 * @author  Adarsh Khatri | me.adarshkhatri@gmail.com
 * @url easymart.com.au
 */

namespace EasyMart\PriceDecimal\Plugin\Pricing\Render;

use Magento\Framework\Pricing\PriceCurrencyInterface;

class Amount
{
	/** @var \Magento\Framework\Pricing\PriceCurrencyInterface  */
    protected $priceCurrency;

    /**
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        PriceCurrencyInterface $priceCurrency
    ) {
        $this->priceCurrency  = $priceCurrency;
        
    }
	
	/**
     * Format price value
	 *
	 * around function of Magento\Framework\Pricing\Render\Amount::formatCurrency()
     *
     * @param float $amount
     * @param bool $includeContainer
     * @param int $precision
     * @return float
     */
    public function aroundFormatCurrency(
        \Magento\Framework\Pricing\Render\Amount $subject,
		callable $proceed,
        $price,
		$includeContainer = true,
        $precision = PriceCurrencyInterface::DEFAULT_PRECISION
    ) {
			$priceNumber = floor($price);
			$fraction = $price - $priceNumber;
			if($fraction > 0 && $fraction < 1){
				//do nothing, we use default
			} else{
				$precision = 0;
			}
		
        return $this->priceCurrency->format($price, $includeContainer, $precision);
    }
}
