<?php
/**
 * Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio for the source repository
 */
 
namespace Armenio\Date;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 *
 * DateServiceFactory
 * @author Rafael Armenio <rafael.armenio@gmail.com>
 *
 *
 */
class DateServiceFactory implements FactoryInterface
{
    /**
     * zend-servicemanager v2 factory for creating Date instance.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @returns Date
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $date = new Date();
        return $date;
    }
}
