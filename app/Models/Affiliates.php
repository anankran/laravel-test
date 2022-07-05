<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Affiliates extends Model
{
    /**
     * Gambling office latitude.
     *
     * @var int
     */
    protected $officeLatitude = 53.3340285;

    /**
     * Gambling office longitude.
     *
     * @var int
     */
    protected $officeLongitude = -6.2535495;

    /**
     * Earth radius in meters.
     *
     * @var int
     */
    protected $earthRadius = 6371000;

    /**
     * Decode JSON file and check if affiliates are below a
     * specific distance.
     *
     * @param integer $maxDistance
     * @return array
     */
    public function listByDistanceASC(int $maxDistance): array
    {
        $formattedAffiliates = array();
        $affiliates = Storage::disk('local')->get('affiliates.txt');
        $affiliates = explode(PHP_EOL, $affiliates);
        $affiliates = array_filter(
            $affiliates,
            function($affiliates) use ($maxDistance) {
                return $this->filterAffiliates($affiliates, $maxDistance);
            }
        );

        foreach ($affiliates as $affiliate) {
            $affiliate = json_decode($affiliate);
            $id = $affiliate->affiliate_id;
            $formattedAffiliates[$id] = array();
            $formattedAffiliates[$id] = new \stdClass();
            $formattedAffiliates[$id]->id = $id;
            $formattedAffiliates[$id]->name = $affiliate->name;
        }

        ksort($formattedAffiliates);
        return $formattedAffiliates;
    }

    /**
     * Filter affiliates based on a specific distance.
     *
     * @param array $affiliate
     * @param integer $maxDistance
     * @return boolean
     */
    protected function filterAffiliates($affiliate, $maxDistance)
    {
        $affiliate = json_decode($affiliate);
        $isInRange = $this->checkDistanceIsInRange(
            $affiliate->latitude,
            $affiliate->longitude,
            $maxDistance
        );
        return $isInRange ? $affiliate : null;
    }

    /**
     * Check if coordinates are balow a specific distance.
     *
     * @param integer $maxDistance
     * @param integer $affiliateLatitude
     * @param integer $affiliateLongitude
     * @return boolean
     */
    public function checkDistanceIsInRange(
        int $affiliateLatitude,
        int $affiliateLongitude,
        int $maxDistance
    ): bool {
        $latitudeFrom = deg2rad($affiliateLatitude);
        $longitudeFrom = deg2rad($affiliateLongitude);
        $latitudeTo = deg2rad($this->officeLatitude);
        $longitudeTo = deg2rad($this->officeLongitude);
        $longitudeDelta = $longitudeTo - $longitudeFrom;

        $a = pow(cos($latitudeTo) * sin($longitudeDelta), 2) +
            pow(cos($latitudeFrom) * sin($latitudeTo) -
            sin($latitudeFrom) * cos($latitudeTo) * cos($longitudeDelta), 2);
        $b = sin($latitudeFrom) * sin($latitudeTo) +
            cos($latitudeFrom) * cos($latitudeTo) * cos($longitudeDelta);

        $angle = atan2(sqrt($a), $b);
        $distanceInMeters = $angle * $this->earthRadius;

        return $distanceInMeters <= $maxDistance;
    }
}
