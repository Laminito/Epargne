<?php


namespace App\ApiPlatform;

use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;

class AutoGroupResourceMetadataFactory implements ResourceMetadataFactoryInterface
{

    private $decorated;
    public function __construct(ResourceMetadataFactoryInterface $decorated)
    {
    $this->decorated = $decorated;
    }


    /**
     * Creates a resource metadata.
     *
     * @throws ResourceClassNotFoundException
     */
    public function create(string $resourceClass): ResourceMetadata{

        $resourceMetadata = $this->decorated->create($resourceClass);
        return $resourceMetadata;

    }

}
