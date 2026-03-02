<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Business\Expander;

use Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer;
use Generated\Shared\Transfer\RestCheckoutDataTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Dependency\Facade\CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeInterface;

class CheckoutDataExpander implements CheckoutDataExpanderInterface
{
    /**
     * @var \Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Dependency\Facade\CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    public function __construct(
        CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
    ) {
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
    }

    public function expandCheckoutDataWithCompanyBusinessUnitAddresses(
        RestCheckoutDataTransfer $restCheckoutDataTransfer,
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestCheckoutDataTransfer {
        if (
            !$restCheckoutRequestAttributesTransfer->getCustomer() ||
            !$restCheckoutRequestAttributesTransfer->getCustomer()->getIdCompanyBusinessUnit()
        ) {
            return $restCheckoutDataTransfer;
        }

        $companyUnitAddressCriteriaFilterTransfer = (new CompanyUnitAddressCriteriaFilterTransfer())
            ->setIdCompanyBusinessUnit(
                $restCheckoutRequestAttributesTransfer->getCustomer()->getIdCompanyBusinessUnit(),
            );

        $companyUnitAddressCollectionTransfer = $this->companyUnitAddressFacade
            ->getCompanyUnitAddressCollection($companyUnitAddressCriteriaFilterTransfer);

        $restCheckoutDataTransfer->setCompanyBusinessUnitAddresses($companyUnitAddressCollectionTransfer);

        return $restCheckoutDataTransfer;
    }
}
