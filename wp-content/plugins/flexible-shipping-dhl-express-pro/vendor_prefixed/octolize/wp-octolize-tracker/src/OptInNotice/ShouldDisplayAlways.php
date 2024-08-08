<?php

namespace FlexibleShippingDhlExpressProVendor\Octolize\Tracker\OptInNotice;

/**
 * Should display always.
 */
class ShouldDisplayAlways implements \FlexibleShippingDhlExpressProVendor\Octolize\Tracker\OptInNotice\ShouldDisplay
{
    /**
     * @inheritDoc
     */
    public function should_display()
    {
        return \true;
    }
}
