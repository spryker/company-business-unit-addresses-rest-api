<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Business\Reader;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestAddressTransfer;
use Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Dependency\Facade\CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeInterface;

class CompanyBusinessUnitAddressReader implements CompanyBusinessUnitAddressReaderInterface
{
    /**
     * @var \Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Dependency\Facade\CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    public function __construct(CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade)
    {
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
    }

    public function getCompanyBusinessUnitAddress(
        RestAddressTransfer $restAddressTransfer,
        QuoteTransfer $quoteTransfer
    ): AddressTransfer {
        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->findCompanyBusinessUnitAddressByUuid(
            (new CompanyUnitAddressTransfer())->setUuid($restAddressTransfer->getIdCompanyBusinessUnitAddress()),
        );

        if (!$this->isCompanyBusinessUnitAddressApplicable($quoteTransfer, $companyUnitAddressResponseTransfer)) {
            return (new AddressTransfer())->fromArray($restAddressTransfer->toArray(), true);
        }

        return (new AddressTransfer())
            ->fromArray($companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer()->toArray(), true)
            ->setUuid(null)
            ->setIsAddressSavingSkipped(true)
            ->setEmail($quoteTransfer->getCustomer()->getEmail())
            ->setFirstName($quoteTransfer->getCustomer()->getFirstName())
            ->setLastName($quoteTransfer->getCustomer()->getLastName())
            ->setSalutation($quoteTransfer->getCustomer()->getSalutation())
            ->setCompany($companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer()->getCompany()->getName())
            ->setCompanyBusinessUnitAddressUuid($companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer()->getUuid());
    }

    protected function isCompanyBusinessUnitAddressApplicable(
        QuoteTransfer $quoteTransfer,
        CompanyUnitAddressResponseTransfer $companyUnitAddressResponseTransfer
    ): bool {
        if (
            !$companyUnitAddressResponseTransfer->getIsSuccessful()
            || !$companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer()
        ) {
            return false;
        }

        return $this->isCurrentCompanyUserInCompany(
            $quoteTransfer,
            $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer(),
        );
    }

    protected function isCurrentCompanyUserInCompany(
        QuoteTransfer $quoteTransfer,
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): bool {
        return $quoteTransfer->getCustomer()->getCompanyUserTransfer()
            && $quoteTransfer->getCustomer()->getCompanyUserTransfer()->getCompany()
            && $quoteTransfer->getCustomer()->getCompanyUserTransfer()->getCompany()->getIdCompany()
            === $companyUnitAddressTransfer->getCompany()->getIdCompany();
    }
}
