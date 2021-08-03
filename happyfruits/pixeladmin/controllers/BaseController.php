<?php

/**
 * Class declaration
 */
class BaseController
{
    var $data = array('css' => array(), 'js' => array());
    var $plugins = array();
    var $is_logged = 0;
    var $require_logged = 1;
    var $not_require_logged = array();
    var $dbh = null;
    var $logged_user = null;
    var $view = null;

    function __construct()
    {
        $actionName = request('action');

        if (empty($actionName))
            $actionName = 'index';
        $this->data['logged_user'] = Users::get_logged_user();
        if ($this->data['logged_user'] && !empty($this->data['logged_user']['user_id']))
            $this->is_logged = 1;
        else if ($this->require_logged && !in_array($actionName, $this->not_require_logged)) {
            set_session_val('redirect_link', get_current_url());
            redirect('dang-nhap');
        }

        $controllerName = request('controller');
        if (empty($controllerName))
            $controllerName = 'default';
        if ($this->require_logged && !Users::can_access($controllerName, $actionName)) {
            set_last_error("Bạn không có quyền truy cập trang http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI].");
            redirect();
        }

        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $this->data['view'] = $controllerName;
        $this->data['action'] = $actionName;

        global $dbh;
        $this->dbh = $dbh;
        $this->logged_user = $this->data['logged_user'];
        $this->view = $this->data['view'];
        $this->action = $this->data['action'];

        $this->load_model('Branches');
        $this->data['branches_arr'] = $this->Branches->get_list_with_id_as_key(array('select' => 'id,lat,lng'));
    }

    function load_model($model_name)
    {
        if ($model_name == '*') {
            foreach (glob(ABSOLUTE_PATH . 'models/common/*.php') as $m) {
                require_once $m;
                $path_info = pathinfo($m);
                $name = $path_info['filename'];
                $this->$name = new $name;
            }
        } else {
            $models = explode(',', $model_name);
            if (!empty($models)) {
                foreach ($models as $m) {
                    $m = trim($m);
                    if (file_exists(ABSOLUTE_PATH . "models/common/$m.php")) {
                        require_once(ABSOLUTE_PATH . "models/common/$m.php");
                        $this->$m = new $m;
                    }
                }
            }
        }
    }

    function load_file($file_path, $return = 0)
    {
        global $controlerObj, $menu_items, $URIs, $other_menu_items;
        if (file_exists($file_path)) {
            extract($this->data);
            if ($return) {
                ob_start();
                include($file_path);
                return ob_get_clean();
            } else
                include($file_path);
        }
    }

    function load_view($view_path, $return = 0)
    {
        $view_path = str_replace('.php', '', $view_path);
        $path = ABSOLUTE_PATH . "views/$view_path.php";
        if ($return)
            return $this->load_file($path, $return);
        else
            $this->load_file($path, $return);
    }

    function load_page($page_path, $show_nav = 1)
    {
        $this->load_plugins();
        $this->data['show_nav'] = $show_nav;
        $this->load_view('elements/header');
        if ($show_nav) {
            $this->load_view('elements/nav');
            $this->load_view('elements/menu');
        }
        $this->load_view($page_path);
        $this->load_view('elements/footer');
    }

    /*
    function load_layout_page($page_path, $layout = 'frontend')
    {
        $this->load_plugins();
        $this->load_view("elements/layout/header_$layout");
        $this->load_view($page_path);
        $this->load_view("elements/layout/footer_$layout");
    }
    */

    function load_template($template_name)
    {
        $this->load_plugins();
        $this->load_theme_file('header');
        $this->load_theme_file($template_name);
        $this->load_theme_file('footer');
    }

    function load_theme_file($file_path, $return = 0)
    {
        if (!strstr($file_path, '.php'))
            $file_path .= '.php';

        $path = EFRUIT_ABSOLUTE_PATH . $file_path;
        if ($child = env('CHILD_THEME')) {
            if (!file_exists($path))
                $path = EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . "/child/$child/" . $file_path;
            if (!file_exists($path))
                $path = EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . "/child/$child/views/" . $file_path;
        }
        if (!file_exists($path))
            $path = EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . '/' . $file_path;
        if (!file_exists($path))
            $path = EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . '/views/' . $file_path;
        if ($return)
            return $this->load_file($path, $return);
        else
            $this->load_file($path, $return);
    }






    function load_partial($file_path, $data = array(), $return = 0)
    {
        if (!strstr($file_path, '.php'))
            $file_path .= '.php';
        $path = EFRUIT_ABSOLUTE_PATH . $file_path;
        if ($child = env('CHILD_THEME')) {
            if (!file_exists($path))
                $path = EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . "/child/$child/partial-" . $file_path;
            if (!file_exists($path))
                $path = EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . "/child/$child/partials/" . $file_path;
        }
        if (!file_exists($path))
            $path = EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . '/partial-' . $file_path;
        if (!file_exists($path))
            $path = EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . '/partials/' . $file_path;
        $this->data = array_merge($this->data, $data);
        if ($return)
            return $this->load_file($path, $return);
        else
            $this->load_file($path, $return);
    }

    function is_theme_view($file_path)
    {
        if (!strstr($file_path, '.php'))
            $file_path .= '.php';
        $child_view = false;
        if ($child = env('CHILD_THEME')) {
            $child_view = file_exists(EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . "/child/$child/views/" . $file_path);
        }
        return $child_view || file_exists(EFRUIT_ABSOLUTE_PATH . 'themes/' . ACTIVE_THEME . '/views/' . $file_path);
    }

    function load_plugins()
    {
        if ($this->plugins) {
            if (!is_array($this->plugins) && is_string($this->plugins) && !empty($this->plugins))
                $this->plugins = explode(',', $this->plugins);
            foreach ($this->plugins as $plugin) {
                $this->load_plugin(trim($plugin));
            }
        }
    }

    function load_plugin($plugin_name)
    {
        if (empty($plugin_name))
            return 0;
        $js = $css = array();
        switch ($plugin_name) {
            case 'dataTables':
                $css = array(
                    ASSET_URL . "plugins/dataTables/dataTables.bootstrap.css",
                    ASSET_URL . "plugins/dataTables/dataTables.responsive.css"
                );
                $js = array(
                    ASSET_URL . "plugins/dataTables/jquery.dataTables.js",
                    ASSET_URL . "plugins/dataTables/dataTables.responsive.js",
                    ASSET_URL . "plugins/dataTables/dataTables.bootstrap.js"
                );
                break;
            case 'tooltipster':
                $css = array(
                    ASSET_URL . 'plugins/tooltipster/tooltipster.min.css',
                    ASSET_URL . 'plugins/tooltipster/tooltipster-shadow.min.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/tooltipster/jquery.tooltipster.min.js'
                );
                break;
            case 'download':
                $js = array(
                    ASSET_URL . 'plugins/download/download.min.js'
                );
                break;
            case 'googleapis':
                global $scheme;
                $js = array(
                    (!empty($scheme) ? $scheme : 'http://') . 'maps.googleapis.com/maps/api/js?key=' . env('GMAP_API_KEY', 'AIzaSyB4tmVxcWyfYgq2rGQZSwe7XP4PbXJ58s4')
                );
                break;
            case 'validator':
                $js = array(
                    ASSET_URL . 'plugins/validator/validator.js'
                );
                break;
            case 'icheck':
                $css = array(
                    ASSET_URL . 'plugins/icheck/square/blue.min.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/icheck/icheck.js'
                );
                break;
            case 'datepicker':
                $css = array(
                    ASSET_URL . 'plugins/datepicker/datepicker.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/datepicker/bootstrap-datepicker.js',
                    ASSET_URL . 'plugins/datepicker/bootstrap-datepicker.vn.js'
                );
                break;
            case 'jquery-ui':
                $css = array(
                    ASSET_URL . 'plugins/jquery-ui/jquery-ui.1.11.2.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/jquery-ui/jquery-ui.1.11.2.js'
                );
                break;
            case 'highcharts':
                $js = array(
                    ASSET_URL . 'plugins/highcharts/highcharts.js',
                    ASSET_URL . 'plugins/highcharts/highcharts-3d.js',
                    ASSET_URL . 'plugins/highcharts/modules/exporting.js',
                    ASSET_URL . 'plugins/highcharts/highcharts.vn.js',
                );
                break;
            case 'growl':
                $css = array(
                    ASSET_URL . 'plugins/growl/jquery.growl.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/growl/jquery.growl.js'
                );
                break;
            case 'chosen':
                $css = array(
                    ASSET_URL . 'plugins/chosen/chosen.min.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/chosen/chosen.jquery.min.js'
                );
                break;
            case 'ckeditor':
                $js = array(
                    ASSET_URL . 'plugins/ckeditor/ckeditor.js',
                    ASSET_URL . 'plugins/ckeditor/adapters/jquery.js',
                );
                break;
            case 'jqueryfileupload':
                $js = array(
                    ASSET_URL . 'plugins/jqueryfileupload/jquery.ui.widget.js',
                    ASSET_URL . 'plugins/jqueryfileupload/load-image.all.min.js',
                    ASSET_URL . 'plugins/jqueryfileupload/canvas-to-blob.min.js',
                    ASSET_URL . 'plugins/jqueryfileupload/jquery.iframe-transport.js',
                    ASSET_URL . 'plugins/jqueryfileupload/jquery.fileupload.js',
                    ASSET_URL . 'plugins/jqueryfileupload/jquery.fileupload-process.js',
                    ASSET_URL . 'plugins/jqueryfileupload/jquery.fileupload-image.js',
                    ASSET_URL . 'plugins/jqueryfileupload/jquery.fileupload-validate.js',
                );
                break;
            case 'dragarrange':
                $js = array(
                    ASSET_URL . 'plugins/dragarrange/drag-arrange.min.js'
                );
                break;
            case 'lightboxme':
                $css = array(
                    ASSET_URL . 'plugins/lightboxme/lightbox_me.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/lightboxme/jquery.lightbox_me.js'
                );
                break;
            case 'iframeautoheight':
                $js = array(
                    ASSET_URL . 'plugins/iframeautoheight/jquery.browser.js',
                    ASSET_URL . 'plugins/iframeautoheight/jquery.iframe-auto-height.plugin.js'
                );
                break;
            case 'select2':
                $js = array(
                    ASSET_URL . 'plugins/select2/select2.full.min.js'
                );
                break;
            case 'bootstrap-iconpicker':
                $css = array(
                    ASSET_URL . 'plugins/bootstrap-iconpicker/bootstrap-iconpicker.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/bootstrap-iconpicker/iconset/iconset-fontawesome-4.2.0.min.js',
                    ASSET_URL . 'plugins/bootstrap-iconpicker/bootstrap-iconpicker.js'
                );
                break;
            case 'minicolors':
                $js = array(
                    ASSET_URL . 'plugins/minicolors/minicolors.js'
                );
                break;
            case 'timepicker':
                $css = array(
                    ASSET_URL . 'plugins/timepicker/timepicker.min.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/timepicker/bootstrap-timepicker.js'
                );
                break;
            case 'imageselector':
                $js = array(
                    ASSET_URL . 'plugins/imageselector/imageselector.js'
                );
                break;
            case 'bootstrap-datetimepicker':
                $css = array(
                    ASSET_URL . 'plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/bootstrap-datetimepicker/moment-with-locales.js',
                    ASSET_URL . 'plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js'
                );
                break;
            case 'rsa':
                $js = array(
                    BASE_URL . 'includes/rsa/jsbn.js',
                    BASE_URL . 'includes/rsa/rsa.js'
                );
                break;
            case 'bootstrap3-editable':
                $css = array(
                    ASSET_URL . 'plugins/bootstrap3-editable/bootstrap-editable.css'
                );
                $js = array(
                    ASSET_URL . 'plugins/bootstrap3-editable/bootstrap-editable.min.js',
                );
                break;
            case 'sortable-lists':
                $js = array(
                    ASSET_URL . 'plugins/sortable-lists/sortableLists.js'
                );
                break;
        }
        if (!empty($css))
            $this->data['css'] = array_merge($css, $this->data['css']);

        if (!empty($js))
            $this->data['js'] = array_merge($js, $this->data['js']);
    }

    function _merge_data($data)
    {
        if (is_array($data)) {
            foreach ($data as $name => $val) {
                if (isset($this->data[$name]) && is_array($this->data[$name]))
                    $this->data[$name] = array_merge($data[$name], $this->data[$name]);
                else
                    $this->data[$name] = $data[$name];
            }
            //$this->data = array_merge($this->data, $data);
        }
    }
}
/* End of BaseController class */
