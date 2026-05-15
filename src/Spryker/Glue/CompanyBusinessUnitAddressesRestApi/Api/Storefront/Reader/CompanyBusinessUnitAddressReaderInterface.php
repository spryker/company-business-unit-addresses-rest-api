<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Reader;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface CompanyBusinessUnitAddressReaderInterface
{
    public function findCompanyUnitAddressByUuid(string $uuid): ?CompanyUnitAddressTransfer;

    /**
     * @param array<int> $idCompanyBusinessUnits
     *
     * @return array<int, array<\Generated\Shared\Transfer\CompanyUnitAddressTransfer>>
     */
    public function getCompanyUnitAddressesGroupedByIdCompanyBusinessUnit(array $idCompanyBusinessUnits): array;
}
