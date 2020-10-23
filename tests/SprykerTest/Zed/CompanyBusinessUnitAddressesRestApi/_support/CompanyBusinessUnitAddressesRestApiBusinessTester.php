<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\CompanyBusinessUnitAddressesRestApi;

use Codeception\Actor;
use Generated\Shared\DataBuilder\CompanyUnitAddressCollectionBuilder;
use Generated\Shared\DataBuilder\CompanyUnitAddressResponseBuilder;
use Generated\Shared\DataBuilder\QuoteBuilder;
use Generated\Shared\DataBuilder\RestCheckoutDataBuilder;
use Generated\Shared\DataBuilder\RestCheckoutRequestAttributesBuilder;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCheckoutDataTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCustomerTransfer;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 * @method \Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Business\CompanyBusinessUnitAddressesRestApiFacade getFacade()
 *
 * @SuppressWarnings(PHPMD)
*/
class CompanyBusinessUnitAddressesRestApiBusinessTester extends Actor
{
    use _generated\CompanyBusinessUnitAddressesRestApiBusinessTesterActions;

    protected const FAKE_ID_COMPANY_BUSINESS_UNIT = 777;

    /**
     * @return \Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer
     */
    public function createCompanyUnitAddressCollectionTransfer(): CompanyUnitAddressCollectionTransfer
    {
        return (new CompanyUnitAddressCollectionBuilder())
            ->withCompanyUnitAddress()
            ->withAnotherCompanyUnitAddress()
            ->build();
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function createCompanyUnitAddressResponseTransfer(): CompanyUnitAddressResponseTransfer
    {
        return (new CompanyUnitAddressResponseBuilder([CompanyUnitAddressResponseTransfer::IS_SUCCESSFUL => true]))
            ->withCompanyUnitAddressTransfer()
            ->build();
    }

    /**
     * @return \Generated\Shared\Transfer\RestCheckoutDataTransfer
     */
    public function createRestCheckoutDataTransfer(): RestCheckoutDataTransfer
    {
        return (new RestCheckoutDataBuilder())->build();
    }

    /**
     * @return \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer
     */
    public function createRestCheckoutRequestAttributesTransfer(): RestCheckoutRequestAttributesTransfer
    {
        return (new RestCheckoutRequestAttributesBuilder())
            ->withCustomer([RestCustomerTransfer::ID_COMPANY_BUSINESS_UNIT => static::FAKE_ID_COMPANY_BUSINESS_UNIT])
            ->build();
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function createQuoteTransfer(): QuoteTransfer
    {
        return (new QuoteBuilder())
            ->withCustomer()
            ->withItem()
            ->withAnotherItem()
            ->build();
    }
}
