<?php

namespace App\Http\Controllers\Admin;


use App\Commons\Common;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Yangqi\Htmldom\Htmldom;

/**
 * Class CrawlToolController
 * @package App\Http\Controllers\Admin
 */
class CrawlToolController extends Controller
{

    /**
     * show tool craweler
     */
    public function index() {

        $tables = $this->getTables();
        $settings = $this->getSetting();
        $tags = Common::$TAGS;
        return view('protected.admin.tool.create', compact('tables', 'settings', 'tags'));
    }

    /**
     * @return array
     */
    public function getTables() {
        $tables = DB::select('SHOW TABLES');
        $tableList = array("" => "select one");
        $ignoreTables = array('migrations', 'groups', 'password_resets', 'throttle', 'users', 'users_groups', 'orders', 'settings');
        foreach($tables as $tab) {
            if(in_array($tab->Tables_in_buy_theme, $ignoreTables)) {
                continue;
            }

            $tableList[$tab->Tables_in_buy_theme] = $tab->Tables_in_buy_theme;
        }

        return $tableList;
    }

    /**
     * @return array
     */
    public function getSetting() {
        $orders = Order::all();
        $orderList = array("" => "select one");
        foreach($orders as $od) {
            $orderList[$od->id] = $od->name;
        }

        return $orderList;
    }

    /**
     * add form setting
     */
    public function addFormSetting(Request $request) {
        $id = $request->id;
        $arrElm = explode('_', $id);
        $margin = count($arrElm);
        $tags = Common::$TAGS;
        $types = Common::$TYPES;
        return view('protected.admin.tool.form-setting', compact('id', 'margin', 'tags', 'types'));
    }

    /**
     * get table field
     */
    public function getTableField(Request $request) {
        $tableName = $request->tableName;
        $columns = Schema::getColumnListing($tableName);
        $fields = array("" => "select one");
        foreach($columns as $col) {
            $fields[$col] = $col;
        }

        return view('protected.admin.tool.select-box', compact('fields'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request) {
        $table = $request->tables;
        $url = $request->url;
        $tags = $request->tags;
        $htmls = $request->htmls;
        $hid_fields = $request->hid_fields;
        $depths = $request->depths;
        $types = $request->types;
        $data = array();
        $arrDepths = $this->divDepth($depths);

        // Start clone content
        $page = new Htmldom($url);

        foreach($arrDepths as $depth) {
            $data = $this->lastValue($data, $page, $depth, $tags, $htmls, $types, $hid_fields, 0);
        }

        // save data into table after crawler
        $count = $this->saveData($table, $data);
        return Redirect::to('admin/tool')->with(['success' => trans('message.SUCCESS'), 'count' => $count]);
    }


    /**
     * save data into table
     * @param $data
     */
    public function saveData($table, $data) {
        $count = 0;
        $modelName = ucfirst(str_singular($table));
        $modelClass = "App\Models\\" . $modelName;
        $keys = array_keys($data);
        if(count($keys) < 1) {
            return 0;
        }
        for($i = 0; $i < count($data[$keys[0]]); $i ++) {
            $model = new $modelClass;
            foreach($keys as $key) {
                $model->$key = $data[$key][$i];
            }
            if($model->save()) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * @param $data
     * @param $page
     * @param $depths
     * @param $tags
     * @param $htmls
     * @param $types
     * @param $hid_fields
     * @param int $count
     * @return mixed
     */
    public function lastValue($data, $page, $depths, $tags, $htmls, $types, $hid_fields, $count) {
        $length = count($depths);
        $tag = $htmls[$depths[$count]] != "" ? $tags[$depths[$count]] . '[' . $htmls[$depths[$count]] . ']' : $tags[$depths[$count]];
        $type = $count > 0 ? $types[$depths[$count]] : '';
        $hid_field = $count > 0 ? $hid_fields[$depths[$count]] : '';

        foreach ($page->find($tag) as $item) {
            if($type == '1') {
                // get text
                $data[$hid_field][] = $item->plaintext;
            }

            if($type == '2') {
                //upload image
                $data[$hid_field][] = $item->src;
            }

            if($type == '3') {
                //get link
                $data[$hid_field][] = $item->href;
            }

            if($count < $length - 1) {
                $count ++;
                $data = $this->lastValue($data, $item, $depths, $tags, $htmls, $types, $hid_fields, $count);
                $count --;
            }
        }

        return $data;

    }

    /**
     * @param $depths
     * @return array
     */
    public function divDepth($depths) {
        $arrDepths = array();
        $parentKey = 0;
        $count = 0;
        foreach($depths as $key => $depth) {
            $arrTmp = explode('_', $depth);
            if(count($arrTmp) > $count) {
                $arrDepths[$parentKey][] = $depth;
                $count = count($arrTmp);
            } else {
                $parentKey ++;
                for($i = 0; $i< count($arrTmp) - 1; $i ++) {
                    $arrDepths[$parentKey][] = $depths[$i];
                }
                $arrDepths[$parentKey][] = $depth;
                $count = count($arrTmp);
            }
        }
        return $arrDepths;
    }

    /**
     * @param Request $request
     */
    public function saveSetting(Request $request) {
        $data = $request->data;
        $table = $data['tables'];
        $url = $data['url'];
        $sName = $data['sName'];
        $setting = $data['setting'];

        $tags = array();
        $htmls = array();
        $types = array();
        $depths = array();
        $hid_fields = array();

        //unset data not an array
        unset($data['_token']);
        unset($data['tables']);
        unset($data['url']);
        unset($data['sName']);
        unset($data['setting']);

        // convert data for each array
        foreach ($data as $key => $item) {
            $arrExplodeKey = explode('[', $key);
            if(count($arrExplodeKey) <= 1) {
                continue;
            }
            $arrExplodeValue = explode(']', $arrExplodeKey[1]);
            switch($arrExplodeKey[0]) {
                case 'tags' :
                    $tags[$arrExplodeValue[0]] = $item;
                    break;

                case 'htmls' :
                    $htmls[$arrExplodeValue[0]] = $item;
                    break;

                case 'types' :
                    $types[$arrExplodeValue[0]] = $item;
                    break;

                case 'depths' :
                    $depths[$arrExplodeValue[0]] = $item;
                    break;

                case 'hid_fields' :
                    $hid_fields[$arrExplodeValue[0]] = $item;
                    break;
            }
        }

        //save data into table order
        $order = new Order();
        $order->table = $table;
        $order->url = $url;
        $order->name = $sName;
        $order->save();

        //save data into table settings
        $isSave = false;
        foreach($tags as $key => $tag) {
            $setting = new Setting();
            $setting->order_id = $order->id;
            $setting->parent_id = $this->getParentID($key);
            $setting->tag = $tag;
            $setting->name = $key;
            $setting->html = isset($htmls[$key]) ? $htmls[$key] : '';
            $setting->type = isset($types[$key]) ? $types[$key] : 0;
            $setting->field = isset($hid_fields[$key]) ? $hid_fields[$key] : '';
            $isSave = $setting->save();
        }

        return Response::json($isSave);
    }

    /**
     * @param $name
     * @return int
     */
    public function getParentID($name) {
        $arrTmp = explode('_', $name);
        if(count($arrTmp) < 2) {
            return 0;
        }

        array_pop($arrTmp);
        $parentName = implode('_', $arrTmp);
        $parentID = Setting::where('name', $parentName)->first();
        return $parentID->id;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function loadSetting(Request $request) {
        $order_id = $request->order;
        $order = Order::find($order_id);
        $settings = $order->setting;
        return Response::json([
            'order' => $order,
            'setting' => $settings
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadSettingItem(Request $request) {
        $id = $request->id;
        $setting = Setting::find($id);
        $arrElm = explode('_', $setting->name);
        $margin = count($arrElm);
        $tags = Common::$TAGS;
        $types = Common::$TYPES;
        return view('protected.admin.tool.form-load-setting', compact('setting', 'margin', 'tags', 'types'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function checkName(Request $request) {
        $name = $request->name;
        $isDuplicate = false;
        $count = Order::where('name', $name)->count();
        if($count > 0) {
            $isDuplicate = true;
        }

        return Response::json($isDuplicate);
    }
} //class