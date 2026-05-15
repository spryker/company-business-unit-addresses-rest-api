<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Provider;

use Generated\Api\Storefront\CompanyBusinessUnitAddressesStorefrontResource;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Exception\CompanyBusinessUnitAddressesExceptionFactory;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Mapper\CompanyUnitAddressResourceMapperInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Reader\CompanyBusinessUnitAddressReaderInterface;
use Spryker\Service\Serializer\SerializerServiceInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CompanyBusinessUnitAddressesStorefrontProvider extends AbstractStorefrontProvider
{
    protected const string KEY_UUID = 'uuid';

    public function __construct(
        protected CompanyBusinessUnitAddressReaderInterface $companyBusinessUnitAddressReader,
        protected CompanyBusinessUnitAddressesExceptionFactory $exceptionFactory,
        protected CompanyUnitAddressResourceMapperInterface $companyUnitAddressResourceMapper,
        protected SerializerServiceInterface $serializer,
    ) {
    }

    protected function provideItem(): ?object
    {
        if (!$this->hasCustomer()) {
            throw new AccessDeniedException();
        }

        return $this->provideCompanyBusinessUnitAddressByUuid(
            (string)$this->getUriVariable(static::KEY_UUID),
        );
    }

    protected function provideCollection(): array
    {
        throw $this->exceptionFactory->createResourceNotImplementedException();
    }

    /**
     * @throws \Spryker\ApiPlatform\Exception\GlueApiException
     */
    protected function provideCompanyBusinessUnitAddressByUuid(
        string $uuid,
    ): CompanyBusinessUnitAddressesStorefrontResource {
        $companyUnitAddressTransfer = $this->companyBusinessUnitAddressReader->findCompanyUnitAddressByUuid($uuid);

        if ($companyUnitAddressTransfer === null) {
            throw $this->exceptionFactory->createCompanyBusinessUnitAddressNotFoundException();
        }

        $idCurrentCompany = $this->getCustomer()->getCompanyUserTransfer()?->getFkCompany();

        if (
            $idCurrentCompany === null
            || $idCurrentCompany !== $companyUnitAddressTransfer->getFkCompany()
        ) {
            throw $this->exceptionFactory->createCompanyBusinessUnitAddressNotFoundException();
        }

        return $this->denormalizeToResource($companyUnitAddressTransfer);
    }

    protected function denormalizeToResource(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer,
    ): CompanyBusinessUnitAddressesStorefrontResource {
        return $this->serializer->denormalize(
            $this->companyUnitAddressResourceMapper->mapCompanyUnitAddressTransferToResourceData($companyUnitAddressTransfer),
            CompanyBusinessUnitAddressesStorefrontResource::class,
        );
    }
}
