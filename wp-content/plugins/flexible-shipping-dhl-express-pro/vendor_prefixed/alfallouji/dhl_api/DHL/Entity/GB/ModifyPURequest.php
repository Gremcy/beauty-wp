<?php

/**
 * Note : Code is released under the GNU LGPL
 *
 * Please do not change the header of this file
 *
 * This library is free software; you can redistribute it and/or modify it under the terms of the GNU
 * Lesser General Public License as published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * See the GNU Lesser General Public License for more details.
 */
/**
 * File:        ModifyPURequest.php
 * Project:     DHL API
 *
 * @author      Al-Fallouji Bashar
 * @version     0.1
 */
namespace FlexibleShippingDhlExpressProVendor\DHL\Entity\GB;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\Base;
/**
 * ModifyPURequest Request model for DHL API
 */
class ModifyPURequest extends \FlexibleShippingDhlExpressProVendor\DHL\Entity\Base
{
    /**
     * Is this object a subobject
     * @var boolean
     */
    protected $_isSubobject = \false;
    /**
     * Name of the service
     * @var string
     */
    protected $_serviceName = 'ModifyPURequest';
    /**
     * @var string
     * Service XSD
     */
    protected $_serviceXSD = 'ModifyPURequest.xsd';
    /**
     * Parameters to be send in the body
     * @var array
     */
    protected $_bodyParams = array('RegionCode' => array('type' => 'string', 'required' => \false, 'subobject' => \false, 'comment' => 'RegionCode', 'minLength' => '2', 'maxLength' => '2', 'enumeration' => 'AP,EU,AM'), 'ConfirmationNumber' => array('type' => 'string', 'required' => \false, 'subobject' => \false, 'minInclusive' => '1', 'maxInclusive' => '999999999'), 'Requestor' => array('type' => 'string', 'required' => \false, 'subobject' => \false), 'Place' => array('type' => 'Place', 'required' => \false, 'subobject' => \true), 'Pickup' => array('type' => 'string', 'required' => \false, 'subobject' => \false), 'PickupContact' => array('type' => 'string', 'required' => \false, 'subobject' => \false), 'OriginSvcArea' => array('type' => 'string', 'required' => \false, 'subobject' => \false, 'maxLength' => '5'));
}
