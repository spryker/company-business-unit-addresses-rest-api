<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Api\Storefront\Exception;

use Spryker\ApiPlatform\Exception\GlueApiException;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\CompanyBusinessUnitAddressesRestApiConfig;
use Symfony\Component\HttpFoundation\Response;

class CompanyBusinessUnitAddressesExceptionFactory
{
    /**
     * BC: legacy `GET /company-business-unit-addresses` (no id) returned a 501 error envelope without a
     * Spryker `code` field at all. We pass an empty string to {@see GlueApiException}
     * so the emitted error envelope matches the legacy contract (no `code` key value).
     */
    protected const string RESPONSE_CODE_RESOURCE_NOT_IMPLEMENTED = '';

    public function createCompanyBusinessUnitAddressNotFoundException(): GlueApiException
    {
        return new GlueApiException(
            Response::HTTP_NOT_FOUND,
            CompanyBusinessUnitAddressesRestApiConfig::RESPONSE_CODE_COMPANY_BUSINESS_UNIT_ADDRESS_NOT_FOUND,
            CompanyBusinessUnitAddressesRestApiConfig::RESPONSE_DETAIL_COMPANY_BUSINESS_UNIT_ADDRESS_NOT_FOUND,
        );
    }

    public function createResourceNotImplementedException(): GlueApiException
    {
        return new GlueApiException(
            Response::HTTP_NOT_IMPLEMENTED,
            static::RESPONSE_CODE_RESOURCE_NOT_IMPLEMENTED,
            CompanyBusinessUnitAddressesRestApiConfig::RESPONSE_DETAIL_RESOURCE_NOT_IMPLEMENTED,
        );
    }
}
