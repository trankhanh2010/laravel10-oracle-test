<?php

namespace App\Http\Controllers\Api\CacheControllers;

use App\Http\Controllers\BaseControllers\BaseApiCacheController;
use App\Models\HIS\PtttGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PtttGroupController extends BaseApiCacheController
{
    public function __construct(Request $request){
        parent::__construct($request); // Gọi constructor của BaseController
        $this->pttt_group = new PtttGroup();
    }
    public function pttt_group($id = null)
    {
        $keyword = mb_strtolower($this->keyword, 'UTF-8');
        if ($keyword != null) {
            $param = [
                'serv_segrs:id,service_id,service_group_id',
                'serv_segrs.service:id,service_name,service_type_id',
                'serv_segrs.service.service_type:id,service_type_name,service_type_code',
                'serv_segrs.service_group:id,service_group_name',
            ];
            $data = $this->pttt_group
                ->where(DB::connection('oracle_his')->raw('lower(pttt_group_code)'), 'like', '%' . $keyword . '%')
                ->orWhere(DB::connection('oracle_his')->raw('lower(pttt_group_name)'), 'like', '%' . $keyword . '%');
            $count = $data->count();
            $data = $data
                ->skip($this->start)
                ->take($this->limit)
                ->with($param)
                ->get();
        } else {
            if ($id == null) {
                $name = $this->pttt_group_name. '_start_' . $this->start . '_limit_' . $this->limit;
                $param = [
                    'serv_segrs:id,service_id,service_group_id',
                    'serv_segrs.service:id,service_name,service_type_id',
                    'serv_segrs.service.service_type:id,service_type_name,service_type_code',
                    'serv_segrs.service_group:id,service_group_name',
                ];
            } else {
                if (!is_numeric($id)) {
                    return return_id_error($id);
                }
                $data = $this->pttt_group->find($id);
                if ($data == null) {
                    return return_not_record($id);
                }
                $name = $this->pttt_group_name . '_' . $id;
                $param = [
                    'serv_segrs',
                    'serv_segrs.service',
                    'serv_segrs.service.service_type',
                    'serv_segrs.service_group',
                ];
            }
            $data = get_cache_full($this->pttt_group, $param, $name, $id, $this->time, $this->start, $this->limit);
        }
        $param_return = [
            'start' => $this->start,
            'limit' => $this->limit,
            'count' => $count ?? $data['count']
        ];
        return return_data_success($param_return, $data ?? $data['data']);
    }
}
