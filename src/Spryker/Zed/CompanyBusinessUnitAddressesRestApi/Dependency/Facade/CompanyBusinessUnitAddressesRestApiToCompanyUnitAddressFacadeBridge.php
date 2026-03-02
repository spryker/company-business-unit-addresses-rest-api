<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeBridge implements CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeInterface
{
    /**
     * @var \Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    /**
     * @param \Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     */
    public function __construct($companyUnitAddressFacade)
    {
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
    }

    public function getCompanyUnitAddressCollection(
        CompanyUnitAddressCriteriaFilterTransfer $criteriaFilterTransfer
    ): CompanyUnitAddressCollectionTransfer {
        return $this->companyUnitAddressFacade->getCompanyUnitAddressCollection($criteriaFilterTransfer);
    }

    public function findCompanyBusinessUnitAddressByUuid(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer {
        return $this->companyUnitAddressFacade->findCompanyBusinessUnitAddressByUuid($companyUnitAddressTransfer);
    }
}
