<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\Persistence\Decorator;

use FlexibleShippingDhlExpressProVendor\WPDesk\Persistence\ElementNotExistsException;
use FlexibleShippingDhlExpressProVendor\WPDesk\Persistence\FallbackFromGetTrait;
use FlexibleShippingDhlExpressProVendor\WPDesk\Persistence\PersistentContainer;
/**
 * Store values as serialized. Thanks to this the strict typing can be used.
 *
 * @package WPDesk\Persistence\Decorator
 */
class SerializedPersistentContainer implements \FlexibleShippingDhlExpressProVendor\WPDesk\Persistence\PersistentContainer
{
    use FallbackFromGetTrait;
    private $container;
    public function __construct(\FlexibleShippingDhlExpressProVendor\WPDesk\Persistence\PersistentContainer $container)
    {
        $this->container = $container;
    }
    public function get($id)
    {
        if ($this->container->has($id)) {
            return \unserialize($this->container->get($id));
        }
        throw new \FlexibleShippingDhlExpressProVendor\WPDesk\Persistence\ElementNotExistsException(\sprintf('Element %s not exists!', $id));
    }
    public function set(string $id, $value)
    {
        if ($value === null) {
            $this->delete($id);
        } else {
            $this->container->set($id, \serialize($value));
        }
    }
    public function delete(string $id)
    {
        $this->container->delete($id);
    }
    public function has($id) : bool
    {
        return $this->container->has($id);
    }
}
