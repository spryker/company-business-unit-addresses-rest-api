<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface CompanyUnitAddressResourceMapperInterface
{
    /**
     * @return array<string, mixed>
     */
    public function mapCompanyUnitAddressTransferToResourceData(CompanyUnitAddressTransfer $companyUnitAddressTransfer): array;
}
