<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HISController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    "middleware" => ["check_module:api"]
], function () {

    /// Khoa phòng
    Route::group(['as' => 'HIS.Desktop.Plugins.HisDepartment'], function () {
        Route::get("department", [HISController::class, "department"]);
        Route::get("department/{id}", [HISController::class, "department_id"]);
    });

    /// Buồng bệnh
    Route::group(['as' => 'HIS.Desktop.Plugins.HisBedRoomList'], function () {
        Route::get("bed-room", [HISController::class, "bed_room"]);
        Route::get("bed-room/{id}", [HISController::class, "bed_room_id"]);
        Route::get('bed-room/{id}/room', [HISController::class, 'bed_room_get_room']);
        Route::get('bed-room/{id}/department', [HISController::class, 'bed_room_get_department']);
        Route::get('bed-room/{id}/area', [HISController::class, 'bed_room_get_area']);
    });

    /// Phòng khám/cls/pttt
    Route::group(['as' => 'HIS.Desktop.Plugins.HisExecuteRoom'], function () {
        Route::get("execute-room", [HISController::class, "execute_room"]);
        Route::get("execute-room/{id}", [HISController::class, "execute_room_id"]);
        Route::get('execute-room/{id}/room', [HISController::class, 'execute_room_get_room']);
        Route::get('execute-room/{id}/department', [HISController::class, 'execute_room_get_department']);
    });

    /// Chuyên khoa
    Route::group(['as' => 'HIS.Desktop.Plugins.HisSpeciality'], function () {
        Route::get("speciality", [HISController::class, "speciality"]);
        Route::get("speciality/{id}", [HISController::class, "speciality_id"]);
    });

    /// Diện điều trị
    Route::get("treatment-type", [HISController::class, "treatment_type"]);
    Route::get("treatment-type/{id}", [HISController::class, "treatment_type_id"]);

    /// Cơ sở khám chữa bệnh ban đầu
    Route::group(['as' => 'HIS.Desktop.Plugins.HisMediOrg'], function () {
        Route::get("medi-org", [HISController::class, "medi_org"]);
        Route::get("medi-org/{id}", [HISController::class, "medi_org_id"]);
    });

    /// Cơ sở/Xã phường
    Route::group(['as' => 'HIS.Desktop.Plugins.HisBranch'], function () {
        Route::get("branch", [HISController::class, "branch"]);
        Route::get("branch/{id}", [HISController::class, "branch_id"]);
    });

    /// Huyện
    Route::group(['as' => 'SDA.Desktop.Plugins.SdaDistrict'], function () {
        Route::get("district", [HISController::class, "district"]);
        Route::get("district/{id}", [HISController::class, "district_id"]);
    });

    /// Kho
    Route::group(['as' => 'HIS.Desktop.Plugins.HisMediStock'], function () {
        Route::get("medi-stock", [HISController::class, "medi_stock"]);
        Route::get("medi-stock/{id}", [HISController::class, "medi_stock_id"]);
        Route::get("medi-stock/{id}/room", [HISController::class, "medi_stock_get_room"]);
        Route::get("medi-stock/{id}/room-type", [HISController::class, "medi_stock_get_room_type"]);
        Route::get("medi-stock/{id}/department", [HISController::class, "medi_stock_get_department"]);
    });

    /// Khu đón tiếp
    Route::group(['as' => 'HIS.Desktop.Plugins.HisReceptionRoom'], function () {
        Route::get("reception-room", [HISController::class, "reception_room"]);
        Route::get("reception-room/{id}", [HISController::class, "reception_room_id"]);
        Route::get("reception-room/{id}/department", [HISController::class, "reception_room_get_department"]);
    });

    /// Khu vực
    Route::group(['as' => 'HIS.Desktop.Plugins.HisArea'], function () {
        Route::get("area", [HISController::class, "area"]);
        Route::get("area/{id}", [HISController::class, "area_id"]);
    });

    /// Nhà ăn
    Route::group(['as' => 'HIS.Desktop.Plugins.HisRefectory'], function () {
        Route::get("refectory", [HISController::class, "refectory"]);
        Route::get("refectory/{id}", [HISController::class, "refectory_id"]);
        Route::get("refectory/{id}/department", [HISController::class, "refectory_get_department"]);
    });

    /// Nhóm thực hiện
    Route::group(['as' => 'HIS.Desktop.Plugins.HisExecuteGroup'], function () {
        Route::get("execute-group", [HISController::class, "execute_group"]);
        Route::get("execute-group/{id}", [HISController::class, "execute_group_id"]);
    });

    /// Phòng thu ngân
    Route::group(['as' => 'HIS.Desktop.Plugins.HisCashierRoom'], function () {
        Route::get("cashier-room", [HISController::class, "cashier_room"]);
        Route::get("cashier-room/{id}", [HISController::class, "cashier_room_id"]);
        Route::get("cashier-room/{id}/room-type", [HISController::class, "cashier_room_get_room_type"]);
        Route::get("cashier-room/{id}/department", [HISController::class, "cashier_room_get_department"]);
        Route::get("cashier-room/{id}/area", [HISController::class, "cashier_room_get_area"]);
    });

    /// Quốc gia
    Route::group(['as' => 'SDA.Desktop.Plugins.SdaNational'], function () {
        Route::get("national", [HISController::class, "national"]);
        Route::get("national/{id}", [HISController::class, "national_id"]);
    });

    /// Tỉnh
    Route::group(['as' => 'SDA.Desktop.Plugins.SdaProvince'], function () {
        Route::get("province", [HISController::class, "province"]);
        Route::get("province/{id}", [HISController::class, "province_id"]);
    });

    /// Tủ bệnh án
    Route::group(['as' => 'HIS.Desktop.Plugins.HisDataStore'], function () {
        Route::get("data-store", [HISController::class, "data_store"]);
        Route::get("data-store/{id}", [HISController::class, "data_store_id"]);
        Route::get("data-store/{id}/department-room", [HISController::class, "data_store_get_department_room"]);
        Route::get("data-store/{id}/department", [HISController::class, "data_store_get_department"]);
    });

    /// Vai trò thực hiện
    Route::group(['as' => 'HIS.Desktop.Plugins.HisExecuteRole'], function () {
        Route::get("execute-role", [HISController::class, "execute_role"]);
        Route::get("execute-role/{id}", [HISController::class, "execute_role_id"]);
    });

    /// Xã
    Route::group(['as' => 'SDA.Desktop.Plugins.SdaCommune'], function () {
        Route::get("commune", [HISController::class, "commune"]);
        Route::get("commune/{id}", [HISController::class, "commune_id"]);
    });

    /// Dịch vụ kỹ thuật
    Route::group(['as' => 'HIS.Desktop.Plugins.HisService'], function () {
        Route::get("service", [HISController::class, "service"]);
        Route::get("service/{id}", [HISController::class, "service_id"]);
    });

    /// Chính sách dịch vụ
    Route::group(['as' => 'HIS.Desktop.Plugins.HisServicePatyList'], function () {
        Route::get("service-paty", [HISController::class, "service_paty"]);
        Route::get("service-paty/{id}", [HISController::class, "service_paty_id"]);
    });

    /// Dịch vụ máy
    Route::group(['as' => 'HIS.Desktop.Plugins.ServiceMachine'], function () {

        /// Dịch vụ
        Route::get("service-machine", [HISController::class, "service_machine"]);
        Route::get("service-machine/{id}", [HISController::class, "service_machine_id"]);

        /// Máy
        Route::get("machine", [HISController::class, "machine"]);
        Route::get("machine/{id}", [HISController::class, "machine_id"]);
    });

    /// Dịch vụ phòng
    Route::group(['as' => 'HIS.Desktop.Plugins.RoomService'], function () {
        Route::get("room-service", [HISController::class, "room_service"]);
        Route::get("room-service/{id}", [HISController::class, "room_service_id"]);
    });
});
