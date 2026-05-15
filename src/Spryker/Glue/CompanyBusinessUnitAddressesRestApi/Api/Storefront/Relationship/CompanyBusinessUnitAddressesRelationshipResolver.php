<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Relationship;

use Generated\Api\Storefront\CompanyBusinessUnitAddressesStorefrontResource;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\ApiPlatform\Relationship\PerItemRelationshipResolverInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Mapper\CompanyUnitAddressResourceMapperInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Reader\CompanyBusinessUnitAddressReaderInterface;
use Spryker\Service\Serializer\SerializerServiceInterface;

class CompanyBusinessUnitAddressesRelationshipResolver implements PerItemRelationshipResolverInterface
{
    public function __construct(
        protected CompanyBusinessUnitAddressReaderInterface $companyBusinessUnitAddressReader,
        protected CompanyUnitAddressResourceMapperInterface $companyUnitAddressResourceMapper,
        protected SerializerServiceInterface $serializer,
    ) {
    }

    /**
     * @param array<object> $parentResources
     * @param array<string, mixed> $context
     *
     * @return array<object>
     */
    public function resolve(array $parentResources, array $context): array
    {
        $allResources = [];

        foreach ($this->resolvePerItem($parentResources, $context) as $resources) {
            $allResources = array_merge($allResources, $resources);
        }

        return $allResources;
    }

    /**
     * @param array<object> $parentResources
     * @param array<string, mixed> $context
     *
     * @return array<string, array<object>>
     */
    public function resolvePerItem(array $parentResources, array $context): array
    {
        $idCompanyBusinessUnitsIndexedByParentResourceUuid = $this->getCompanyBusinessUnitIdsIndexedByParentResourceUuid($parentResources);

        if ($idCompanyBusinessUnitsIndexedByParentResourceUuid === []) {
            return $this->buildEmptyResult($parentResources);
        }

        $addressTransfersByIdCompanyBusinessUnit = $this->companyBusinessUnitAddressReader
            ->getCompanyUnitAddressesGroupedByIdCompanyBusinessUnit(array_values($idCompanyBusinessUnitsIndexedByParentResourceUuid));

        $result = [];

        foreach ($idCompanyBusinessUnitsIndexedByParentResourceUuid as $uuid => $idCompanyBusinessUnit) {
            $addressTransfers = $addressTransfersByIdCompanyBusinessUnit[$idCompanyBusinessUnit] ?? [];
            $result[$uuid] = $this->denormalizeAddressTransfers($addressTransfers);
        }

        return $result;
    }

    /**
     * @param array<object> $parentResources
     *
     * @return array<string, int>
     */
    protected function getCompanyBusinessUnitIdsIndexedByParentResourceUuid(array $parentResources): array
    {
        $idCompanyBusinessUnitsIndexedByParentResourceUuid = [];

        foreach ($parentResources as $parentResource) {
            $uuid = $parentResource->uuid ?? null;
            $idCompanyBusinessUnit = $parentResource->idCompanyBusinessUnit ?? null;

            if ($uuid === null || $idCompanyBusinessUnit === null) {
                continue;
            }

            $idCompanyBusinessUnitsIndexedByParentResourceUuid[$uuid] = $idCompanyBusinessUnit;
        }

        return $idCompanyBusinessUnitsIndexedByParentResourceUuid;
    }

    /**
     * @param array<\Generated\Shared\Transfer\CompanyUnitAddressTransfer> $companyUnitAddressTransfers
     *
     * @return array<\Generated\Api\Storefront\CompanyBusinessUnitAddressesStorefrontResource>
     */
    protected function denormalizeAddressTransfers(array $companyUnitAddressTransfers): array
    {
        $resources = [];

        foreach ($companyUnitAddressTransfers as $companyUnitAddressTransfer) {
            $resources[] = $this->denormalizeToAddressResource($companyUnitAddressTransfer);
        }

        return $resources;
    }

    protected function denormalizeToAddressResource(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
    ): CompanyBusinessUnitAddressesStorefrontResource {
        return $this->serializer->denormalize(
            $this->companyUnitAddressResourceMapper->mapCompanyUnitAddressTransferToResourceData($companyUnitAddressTransfer),
            CompanyBusinessUnitAddressesStorefrontResource::class,
        );
    }

    /**
     * @param array<object> $parentResources
     *
     * @return array<string, array<\Generated\Api\Storefront\CompanyBusinessUnitAddressesStorefrontResource>>
     */
    protected function buildEmptyResult(array $parentResources): array
    {
        $result = [];

        foreach ($parentResources as $parentResource) {
            $uuid = $parentResource->uuid ?? null;

            if ($uuid === null) {
                continue;
            }

            $result[$uuid] = [];
        }

        return $result;
    }
}
