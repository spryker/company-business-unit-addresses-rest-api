<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Dependency\Client;

use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressClientBridge implements CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressClientInterface
{
    /**
     * @var \Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface
     */
    protected $companyBusinessUnitAddressClient;

    /**
     * @param \Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface $companyBusinessUnitAddressClient
     */
    public function __construct($companyBusinessUnitAddressClient)
    {
        $this->companyBusinessUnitAddressClient = $companyBusinessUnitAddressClient;
    }

    public function getCompanyUnitAddressCollection(
        CompanyUnitAddressCriteriaFilterTransfer $criteriaFilterTransfer
    ): CompanyUnitAddressCollectionTransfer {
        return $this->companyBusinessUnitAddressClient->getCompanyUnitAddressCollection($criteriaFilterTransfer);
    }

    public function findCompanyBusinessUnitAddressByUuid(CompanyUnitAddressTransfer $companyUnitAddressTransfer): CompanyUnitAddressResponseTransfer
    {
        return $this->companyBusinessUnitAddressClient->findCompanyBusinessUnitAddressByUuid($companyUnitAddressTransfer);
    }
}
