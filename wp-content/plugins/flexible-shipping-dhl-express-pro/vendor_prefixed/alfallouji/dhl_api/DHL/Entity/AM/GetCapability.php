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
 * File:        GetCapability.php
 * Project:     DHL API
 *
 * @author      Al-Fallouji Bashar
 * @version     0.1
 */
namespace FlexibleShippingDhlExpressProVendor\DHL\Entity\AM;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\Base;
/**
 * GetCapability Request model for DHL API
 */
class GetCapability extends \FlexibleShippingDhlExpressProVendor\DHL\Entity\Base
{
    /**
     * Name of the service
     * @var string
     */
    protected $_serviceName = 'DCTRequest';
    /**
     * @var string
     * Service XSD
     */
    protected $_serviceXSD = 'DCT-req.xsd';
    /**
     * Parent node name of the object 
     * @var string
     */
    protected $_xmlNodeName = 'GetCapability';
    /**
     * Parameters to be send in the body
     * @var array
     */
    protected $_bodyParams = array('From' => array('type' => 'DCTFrom', 'required' => \false, 'subobject' => \true, 'multivalues' => \false, 'minOccurs' => 1), 'BkgDetails' => array('type' => 'BkgDetailsType', 'required' => \false, 'subobject' => \true, 'multivalues' => \false, 'minOccurs' => 1), 'To' => array('type' => 'DCTTo', 'required' => \false, 'subobject' => \true, 'multivalues' => \false, 'minOccurs' => 1), 'Dutiable' => array('type' => 'DCTDutiable', 'required' => \false, 'subobject' => \true, 'multivalues' => \false, 'minOccurs' => 0));
}
