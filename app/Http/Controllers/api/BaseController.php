<?php

namespace App\Http\Controllers\api;

use Auth;
use App\Models\OperationLog;
use App\Enums\OperationType;
use Carbon\Carbon;

use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public static function newListLimit($query)
    {
        $newSizeLimit = 5;
        $arrPageSize = [5, 10, 15];
        if (isset($query['limit_page'])) {
            $newSizeLimit = (($query['limit_page'] === '') || !in_array($query['limit_page'], $arrPageSize)) ? $newSizeLimit : $query['limit_page'];
        }
        if (((isset($query['limit_page']))) && (!empty($query->query('limit_page')))) {
            $newSizeLimit = (!in_array($query->query('limit_page'), $arrPageSize)) ? $newSizeLimit : $query->query('limit_page');
        }
        return $newSizeLimit;
    }
    public function checkPaginatorList($query)
    {
        if ($query->currentPage() > $query->lastPage()) {
            return true;
        }
        return false;
    }
}
