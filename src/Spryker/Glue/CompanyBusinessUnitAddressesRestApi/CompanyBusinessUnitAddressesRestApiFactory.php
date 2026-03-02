<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi;

use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Dependency\Client\CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressClientInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\Mapper\CompanyBusinessUnitAddressMapper;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\Mapper\CompanyBusinessUnitAddressMapperInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\Reader\CompanyBusinessUnitAddressReader;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\Reader\CompanyBusinessUnitAddressReaderInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\Relationship\CompanyBusinessUnitAddressCollectionByCheckoutDataResourceRelationshipExpander;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\Relationship\CompanyBusinessUnitAddressCollectionByCompanyBusinessUnitTransferResourceRelationshipExpander;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\Relationship\CompanyBusinessUnitAddressCollectionResourceRelationshipExpanderInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\RestResponseBuilder\CompanyBusinessUnitAddressRestResponseBuilder;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\RestResponseBuilder\CompanyBusinessUnitAddressRestResponseBuilderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyBusinessUnitAddressesRestApiFactory extends AbstractFactory
{
    public function createCompanyBusinessUnitAddressCollectionByCompanyBusinessUnitTransferResourceRelationshipExpander(): CompanyBusinessUnitAddressCollectionResourceRelationshipExpanderInterface
    {
        return new CompanyBusinessUnitAddressCollectionByCompanyBusinessUnitTransferResourceRelationshipExpander(
            $this->createCompanyBusinessUnitAddressRestResponseBuilder(),
            $this->createCompanyBusinessUnitAddressMapper(),
        );
    }

    public function createCompanyBusinessUnitAddressCollectionByCheckoutDataResourceRelationshipExpander(): CompanyBusinessUnitAddressCollectionResourceRelationshipExpanderInterface
    {
        return new CompanyBusinessUnitAddressCollectionByCheckoutDataResourceRelationshipExpander(
            $this->createCompanyBusinessUnitAddressRestResponseBuilder(),
            $this->createCompanyBusinessUnitAddressMapper(),
        );
    }

    public function createCompanyBusinessUnitAddressReader(): CompanyBusinessUnitAddressReaderInterface
    {
        return new CompanyBusinessUnitAddressReader(
            $this->getCompanyBusinessUnitAddressClient(),
            $this->createCompanyBusinessUnitAddressMapper(),
            $this->createCompanyBusinessUnitAddressRestResponseBuilder(),
        );
    }

    public function createCompanyBusinessUnitAddressMapper(): CompanyBusinessUnitAddressMapperInterface
    {
        return new CompanyBusinessUnitAddressMapper();
    }

    public function createCompanyBusinessUnitAddressRestResponseBuilder(): CompanyBusinessUnitAddressRestResponseBuilderInterface
    {
        return new CompanyBusinessUnitAddressRestResponseBuilder($this->getResourceBuilder());
    }

    public function getCompanyBusinessUnitAddressClient(): CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressClientInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitAddressesRestApiDependencyProvider::CLIENT_COMPANY_UNIT_ADDRESS);
    }
}
