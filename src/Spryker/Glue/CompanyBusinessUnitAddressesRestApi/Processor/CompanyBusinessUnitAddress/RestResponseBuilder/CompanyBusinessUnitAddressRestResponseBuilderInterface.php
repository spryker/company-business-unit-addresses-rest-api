<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\RestResponseBuilder;

use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressesAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface CompanyBusinessUnitAddressRestResponseBuilderInterface
{
    public function createCompanyBusinessUnitAddressRestResponse(
        string $companyBusinessUnitAddressUuid,
        RestCompanyBusinessUnitAddressesAttributesTransfer $restCompanyBusinessUnitAddressesAttributesTransfer
    ): RestResponseInterface;

    public function createCompanyBusinessUnitAddressRestResource(
        string $companyBusinessUnitAddressUuid,
        RestCompanyBusinessUnitAddressesAttributesTransfer $restCompanyBusinessUnitAddressesAttributesTransfer
    ): RestResourceInterface;

    public function createCompanyBusinessUnitAddressNotFoundError(): RestResponseInterface;

    public function createResourceNotImplementedError(): RestResponseInterface;
}
