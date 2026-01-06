<?php

namespace Ashok\CustomerGraphQl\Model\Resolver;

use Magento\CustomerGraphQl\Model\Customer\GetCustomer;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;

class CustomerDetails implements ResolverInterface
{
    /**
     * @var GetCustomer
     */
    private $getCustomer;

    public function __construct(
        GetCustomer $getCustomer
    ) {
        $this->getCustomer = $getCustomer;
    }

    /**
     * Resolver method for GraphQL
     *
     * @param Field $field
     * @param \Magento\GraphQl\Model\Query\ContextInterface $context
     * @param ResolveInfo $info
     * @param array $value
     * @param array $args
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if ($context->getExtensionAttributes()->getIsCustomer() === false)    {
                throw new GraphQlAuthorizationException(
                    __('The current customer isn\'t authorized.')
                );
        }
        $customer = $this->getCustomer->execute($context);

        return [
            'id'        => $customer->getId(),
            'firstname' => $customer->getFirstname(),
            'lastname'  => $customer->getLastname(),
            'email'     => $customer->getEmail()
        ];
    }
}