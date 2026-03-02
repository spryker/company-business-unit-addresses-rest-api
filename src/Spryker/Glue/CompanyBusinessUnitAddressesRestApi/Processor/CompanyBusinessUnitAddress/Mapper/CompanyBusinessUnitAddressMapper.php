<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressesAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAttributesTransfer;

class CompanyBusinessUnitAddressMapper implements CompanyBusinessUnitAddressMapperInterface
{
    public function mapCompanyUnitAddressTransferToRestCompanyBusinessUnitAddressesAttributesTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        RestCompanyBusinessUnitAddressesAttributesTransfer $restCompanyBusinessUnitAddressesAttributesTransfer
    ): RestCompanyBusinessUnitAddressesAttributesTransfer {
        return $restCompanyBusinessUnitAddressesAttributesTransfer->fromArray($companyUnitAddressTransfer->toArray(), true);
    }

    public function mapDefaultBillingAddressIdFromCompanyBusinessUnitTransferToRestCompanyBusinessUnitAttributesTransfer(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        RestCompanyBusinessUnitAttributesTransfer $restCompanyBusinessUnitAttributesTransfer
    ): RestCompanyBusinessUnitAttributesTransfer {
        if (
            !$companyBusinessUnitTransfer->getDefaultBillingAddress()
            || !$this->hasAddressCollection($companyBusinessUnitTransfer)
        ) {
            return $restCompanyBusinessUnitAttributesTransfer->setDefaultBillingAddress(null);
        }

        foreach ($companyBusinessUnitTransfer->getAddressCollection()->getCompanyUnitAddresses() as $companyUnitAddressTransfer) {
            if ($companyUnitAddressTransfer->getIdCompanyUnitAddress() !== $companyBusinessUnitTransfer->getDefaultBillingAddress()) {
                continue;
            }

            $restCompanyBusinessUnitAttributesTransfer->setDefaultBillingAddress($companyUnitAddressTransfer->getUuid());

            return $restCompanyBusinessUnitAttributesTransfer;
        }

        return $restCompanyBusinessUnitAttributesTransfer;
    }

    protected function hasAddressCollection(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): bool
    {
        return $companyBusinessUnitTransfer->getAddressCollection()
            && $companyBusinessUnitTransfer->getAddressCollection()->getCompanyUnitAddresses()->count() > 0;
    }
}
