<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyUnitAddressResourceMapper implements CompanyUnitAddressResourceMapperInterface
{
    /**
     * @return array<string, mixed>
     */
    public function mapCompanyUnitAddressTransferToResourceData(CompanyUnitAddressTransfer $companyUnitAddressTransfer): array
    {
        return [
            'uuid' => $companyUnitAddressTransfer->getUuid(),
            'address1' => $companyUnitAddressTransfer->getAddress1(),
            'address2' => $companyUnitAddressTransfer->getAddress2(),
            'address3' => $companyUnitAddressTransfer->getAddress3(),
            'zipCode' => $companyUnitAddressTransfer->getZipCode(),
            'city' => $companyUnitAddressTransfer->getCity(),
            'phone' => $companyUnitAddressTransfer->getPhone(),
            'iso2Code' => $companyUnitAddressTransfer->getIso2Code(),
            'comment' => $companyUnitAddressTransfer->getComment(),
        ];
    }
}
