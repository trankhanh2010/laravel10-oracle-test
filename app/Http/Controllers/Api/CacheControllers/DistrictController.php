<?php

namespace App\Http\Controllers\Api\CacheControllers;

use Illuminate\Http\Request;
use App\Events\Cache\DeleteCache;
use App\Http\Controllers\BaseControllers\BaseApiCacheController;
use App\Models\SDA\District;
use App\Http\Requests\District\CreateDistrictRequest;
use App\Http\Requests\District\UpdateDistrictRequest;
class DistrictController extends BaseApiCacheController
{
    public function __construct(Request $request){
        parent::__construct($request); // Gọi constructor của BaseController
        $this->district = new District();
    }
    public function district($id = null)
    {
        if ($id == null) {
            $name = $this->district_name;
            $param = [
                'province:id,province_name,province_code',
            ];
        } else {
            if (!is_numeric($id)) {
                return return_id_error($id);
            }
            $data = $this->district->find($id);
            if ($data == null) {
                return return_not_record($id);
            }
            $name = $this->district_name . '_' . $id;
            $param = [
                'province:id,province_name,province_code',
                'communes'
            ];
        }
        $data = get_cache_full($this->district, $param, $name, $id, $this->time);
        $count = $data->count();
        $param_return = [
            'start' => null,
            'limit' => null,
            'count' => $count
        ];
        return return_data_success($param_return, $data);
    }

    public function district_create(CreateDistrictRequest $request)
    {
        $data = $this->district::create([
            'create_time' => now()->format('Ymdhis'),
            'modify_time' => now()->format('Ymdhis'),
            'creator' => get_loginname_with_token($request->bearerToken(), $this->time),
            'modifier' => get_loginname_with_token($request->bearerToken(), $this->time),
            'app_creator' => $this->app_creator,
            'app_modifier' => $this->app_modifier,
            'district_code' => $request->district_code,
            'district_name' => $request->district_name,
            'initial_name' => $request->initial_name,
            'search_code' => $request->search_code,
            'province_id' => $request->province_id,
        ]);
        // Gọi event để xóa cache
        event(new DeleteCache($this->district_name));
        return return_data_create_success($data);
    }

    public function district_update(UpdateDistrictRequest $request, $id)
    {
        if (!is_numeric($id)) {
            return return_id_error($id);
        }
        $data = $this->district->find($id);
        if ($data == null) {
            return return_not_record($id);
        }
        $data_update = [
            'modify_time' => now()->format('Ymdhis'),
            'modifier' => get_loginname_with_token($request->bearerToken(), $this->time),
            'app_modifier' => $this->app_modifier,
            'district_code' => $request->district_code,
            'district_name' => $request->district_name,
            'initial_name' => $request->initial_name,
            'search_code' => $request->search_code,
            'province_id' => $request->province_id,
        ];
        $data->fill($data_update);
        $data->save();
        // Gọi event để xóa cache
        event(new DeleteCache($this->district_name));
        return return_data_update_success($data);
    }

    public function district_delete(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return return_id_error($id);
        }
        $data = $this->district->find($id);
        if ($data == null) {
            return return_not_record($id);
        }
        try {
            $data->delete();
            // Gọi event để xóa cache
            event(new DeleteCache($this->district_name));
            return return_data_delete_success();
        } catch (\Exception $e) {
            return return_data_delete_fail();
        }
    }
}
