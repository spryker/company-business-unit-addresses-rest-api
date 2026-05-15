<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Reader;

use Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface;

class CompanyBusinessUnitAddressReader implements CompanyBusinessUnitAddressReaderInterface
{
    public function __construct(
        protected CompanyUnitAddressClientInterface $companyUnitAddressClient,
    ) {
    }

    public function findCompanyUnitAddressByUuid(string $uuid): ?CompanyUnitAddressTransfer
    {
        $companyUnitAddressResponseTransfer = $this->companyUnitAddressClient->findCompanyBusinessUnitAddressByUuid(
            (new CompanyUnitAddressTransfer())->setUuid($uuid),
        );

        if (!$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            return null;
        }

        return $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer();
    }

    /**
     * @param array<int> $idCompanyBusinessUnits
     *
     * @return array<int, array<\Generated\Shared\Transfer\CompanyUnitAddressTransfer>>
     */
    public function getCompanyUnitAddressesGroupedByIdCompanyBusinessUnit(array $idCompanyBusinessUnits): array
    {
        if ($idCompanyBusinessUnits === []) {
            return [];
        }

        $criteriaFilterTransfer = (new CompanyUnitAddressCriteriaFilterTransfer())
            ->setCompanyBusinessUnitIds($idCompanyBusinessUnits);

        $companyUnitAddressTransfers = $this->companyUnitAddressClient
            ->getCompanyUnitAddressCollection($criteriaFilterTransfer)
            ->getCompanyUnitAddresses()
            ->getArrayCopy();

        return $this->groupCompanyUnitAddressesByIdCompanyBusinessUnit(
            $companyUnitAddressTransfers,
            $idCompanyBusinessUnits,
        );
    }

    /**
     * @param array<\Generated\Shared\Transfer\CompanyUnitAddressTransfer> $companyUnitAddressTransfers
     * @param array<int> $idCompanyBusinessUnits
     *
     * @return array<int, array<\Generated\Shared\Transfer\CompanyUnitAddressTransfer>>
     */
    protected function groupCompanyUnitAddressesByIdCompanyBusinessUnit(
        array $companyUnitAddressTransfers,
        array $idCompanyBusinessUnits
    ): array {
        $requestedIds = array_fill_keys($idCompanyBusinessUnits, true);
        $grouped = array_fill_keys($idCompanyBusinessUnits, []);

        foreach ($companyUnitAddressTransfers as $companyUnitAddressTransfer) {
            $this->assignCompanyUnitAddressToBusinessUnits($companyUnitAddressTransfer, $requestedIds, $grouped);
        }

        return $grouped;
    }

    /**
     * @param array<int, true> $requestedIds
     * @param array<int, array<\Generated\Shared\Transfer\CompanyUnitAddressTransfer>> $grouped
     */
    protected function assignCompanyUnitAddressToBusinessUnits(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
        array $requestedIds,
        array &$grouped
    ): void {
        $companyBusinessUnitCollectionTransfer = $companyUnitAddressTransfer->getCompanyBusinessUnits();

        if ($companyBusinessUnitCollectionTransfer === null) {
            return;
        }

        foreach ($companyBusinessUnitCollectionTransfer->getCompanyBusinessUnits() as $companyBusinessUnitTransfer) {
            $idCompanyBusinessUnit = $companyBusinessUnitTransfer->getIdCompanyBusinessUnit();

            if ($idCompanyBusinessUnit === null || !isset($requestedIds[$idCompanyBusinessUnit])) {
                continue;
            }

            $grouped[$idCompanyBusinessUnit][] = $companyUnitAddressTransfer;
        }
    }
}
