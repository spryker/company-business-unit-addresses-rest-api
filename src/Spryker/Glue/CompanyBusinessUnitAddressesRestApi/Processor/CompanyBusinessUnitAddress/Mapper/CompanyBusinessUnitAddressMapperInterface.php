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

interface CompanyBusinessUnitAddressMapperInterface
{
    public function mapCompanyUnitAddressTransferToRestCompanyBusinessUnitAddressesAttributesTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        RestCompanyBusinessUnitAddressesAttributesTransfer $restCompanyBusinessUnitAddressesAttributesTransfer
    ): RestCompanyBusinessUnitAddressesAttributesTransfer;

    public function mapDefaultBillingAddressIdFromCompanyBusinessUnitTransferToRestCompanyBusinessUnitAttributesTransfer(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        RestCompanyBusinessUnitAttributesTransfer $restCompanyBusinessUnitAttributesTransfer
    ): RestCompanyBusinessUnitAttributesTransfer;
}
