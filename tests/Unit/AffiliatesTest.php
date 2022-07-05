<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\Controller;
use App\Models\Affiliates;

/*
{"latitude": "51.92893", "affiliate_id": 1, "name": "Lance Keith", "longitude": "-10.27699"}
{"latitude": "53.807778", "affiliate_id": 28, "name": "Macsen Freeman", "longitude": "-7.714444"}
*/

class AffiliatesTest extends TestCase
{
    /**
     * Check fot false if values are above the distance.
     *
     * @return void
     */
    public function testIfIsNotInDistanceRange()
    {
        $affiliates = new Affiliates();
        $this->assertFalse($affiliates->checkDistanceIsInRange(
            52.986375,
            -6.043701,
            100000
        ));
    }

    /**
     * Check fot true if values are below the distance.
     *
     * @return void
     */
    public function testIfIsInDistanceRange()
    {
        $affiliates = new Affiliates();
        $this->assertTrue($affiliates->checkDistanceIsInRange(
            53.807778,
            -7.714444,
            100000
        ));
    }

    /**
     * Check if any invalid distance value are given.
     *
     * @return void
     */
    public function testForInvalidDistance()
    {
        $affiliates = new Affiliates();
        $this->assertEmpty($affiliates->listByDistanceASC(-1));
    }
}
