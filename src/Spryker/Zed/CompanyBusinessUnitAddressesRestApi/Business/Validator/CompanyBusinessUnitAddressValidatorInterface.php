<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Business\Validator;

use Generated\Shared\Transfer\CheckoutDataTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;

interface CompanyBusinessUnitAddressValidatorInterface
{
    public function validateCompanyBusinessUnitAddressesInCheckoutData(
        CheckoutDataTransfer $checkoutDataTransfer
    ): CheckoutResponseTransfer;
}
