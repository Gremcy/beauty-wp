<?php

namespace FlexibleShippingDhlExpressProVendor\Octolize\Tracker\OptInNotice;

/**
 * Should display never.
 */
class ShouldDisplayNever implements \FlexibleShippingDhlExpressProVendor\Octolize\Tracker\OptInNotice\ShouldDisplay
{
    /**
     * @inheritDoc
     */
    public function should_display()
    {
        return \false;
    }
}
