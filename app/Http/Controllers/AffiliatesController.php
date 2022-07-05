<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Affiliates;
 
class AffiliatesController extends Controller
{
    /**
     * List all affiliates below a 10000m distance.
     *
     * @return array
     */
    public static function list(): array
    {
        $affiliates = new Affiliates();
        return $affiliates->listByDistanceASC(100000);
    }
}