<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitAddressesRestApi;

use Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Dependency\Facade\CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Spryker\Zed\CompanyBusinessUnitAddressesRestApi\CompanyBusinessUnitAddressesRestApiConfig getConfig()
 */
class CompanyBusinessUnitAddressesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_UNIT_ADDRESS = 'FACADE_COMPANY_UNIT_ADDRESS';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addCompanyUnitAddressFacade($container);

        return $container;
    }

    protected function addCompanyUnitAddressFacade(Container $container): Container
    {
        $container->set(static::FACADE_COMPANY_UNIT_ADDRESS, function (Container $container) {
            return new CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressFacadeBridge(
                $container->getLocator()->companyUnitAddress()->facade(),
            );
        });

        return $container;
    }
}
