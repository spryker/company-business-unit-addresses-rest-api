<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanyBusinessUnitAddressesRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_COMPANY_BUSINESS_UNIT_ADDRESSES = 'company-business-unit-addresses';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_COMPANY_BUSINESS_UNIT_ADDRESSES = 'company-business-unit-addresses-resource';

    /**
     * @deprecated Will be removed with next major release.
     *
     * @var string
     */
    public const ACTION_COMPANY_BUSINESS_UNIT_ADDRESSES_GET = 'get';

    /**
     * @var string
     */
    public const RESPONSE_CODE_COMPANY_BUSINESS_UNIT_ADDRESS_NOT_FOUND = '2001';

    /**
     * @var string
     */
    public const RESPONSE_DETAIL_COMPANY_BUSINESS_UNIT_ADDRESS_NOT_FOUND = 'Company business unit address not found.';

    /**
     * @var string
     */
    public const RESPONSE_CODE_COMPANY_USER_NOT_SELECTED = '2003';

    /**
     * @var string
     */
    public const RESPONSE_DETAIL_COMPANY_USER_NOT_SELECTED = 'Current company user is not set. You need to select the current company user with /company-user-access-tokens in order to access the resource collection.';

    /**
     * @var string
     */
    public const RESPONSE_DETAIL_RESOURCE_NOT_IMPLEMENTED = 'Resource is not implemented.';

    /**
     * @uses \Spryker\Glue\GlueApplication\GlueApplicationConfig::COLLECTION_IDENTIFIER_CURRENT_USER
     *
     * @var string
     */
    public const COLLECTION_IDENTIFIER_CURRENT_USER = 'mine';
}
