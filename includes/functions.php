<?php
/**
 * lang
 * Return the website languages.
 *
 * @param null
 * @return object
 */
function lang() {

    $lang_cookie = (isset($_COOKIE['lang']))
    ? secure(strtolower($_COOKIE['lang']))
    : (strtolower(settings()->site_language));

    $lang = json_decode(
        file_get_contents("languages/".$lang_cookie.".json")
    );
    return $lang;
}


function statics($table, $id)
{
    $database = database::getInstance();

    return $database->select("*")
    ->from($table)
    ->where(["id" => $id])
    ->getOne();
}


function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if(strpos($t, 'opera') || strpos($t, 'opr/')) return 'Opera';
    elseif(strpos($t, 'edge')) return 'Edge';
    elseif(strpos($t, 'chrome')) return 'Chrome';
    elseif(strpos($t, 'safari')) return 'Safari';
    elseif(strpos($t, 'firefox')) return 'Firefox';
    elseif(strpos($t, 'msie') || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unkown';
}

function isAdmin()
{
    return 1 == $_SESSION["is_admin"];
}

function product_rate($id)
{
    $database = database::getInstance();
    $product = $database->select("*")
    ->from(TABLE__RATINGS)
    ->where(["product_id" => $id])
    ->getOne();

    $total_user_rated = (int) ($product->total_users_rated*5);
    $total_rating = (int) ($product->total_ratings*5);
    $rate = ($total_rating / $total_user_rated);
    return (int) $rate;
}

function product_discount($id)
{
    return round(( ($id->price - $id->sale) / $id->price) * 100);
}

function getCreditCardType($str, $format = 'string')
{
    if (empty($str)) {
        return false;
    }

    $matchingPatterns = [
        'visa' => '/^4[0-9]{12}(?:[0-9]{3})?$/',
        'mastercard' => '/^5[1-5][0-9]{14}$/',
        'amex' => '/^3[47][0-9]{13}$/',
        'diners' => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
        'discover' => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
        'jcb' => '/^(?:2131|1800|35\d{3})\d{11}$/',
        'any' => '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'
    ];

    $ctr = 1;
    foreach ($matchingPatterns as $key=>$pattern) {
        if (preg_match($pattern, $str)) {
            return $format == 'string' ? $key : $ctr;
        }
        $ctr++;
    }
}

function logs($id = false, $name = false)
{
    $geo = new geo;
    $geo->locate($_SERVER["REMOTE_ADDR"]);

    $activities = [
        1 => 'Created',
        2 => 'Edited',
        3 => 'Deleted',
        4 => 'Login',
        5 => 'Logout'
    ];

    $data = array(
        "username"      => $_SESSION["username"],
        "ip"            => $_SERVER["REMOTE_ADDR"],
        "activity_id"   => $id,
        "activity_name" => $activities[$id]." ".$name,
        "created_at"    => date("Y-m-d H:i:s"),
        "country"       => $geo->countryName,
        "countryCode"   => $geo->countryCode,
        "browser"       => get_browser_name($_SERVER['HTTP_USER_AGENT'])
    );
    $db = database::getInstance();
    $db->set($data)->insert(TABLE__LOGS);
    $db->close();
    unset($db);
}


function buildCatTable($parent = 0, $sub_mark="") {
    $database = database::getInstance();

    $cats = $database->select("*")
    ->from(TABLE__CATEGORIES)
    ->where(["parent_id" => $parent])
    ->orderBy("parent_id, id asc")
    ->get();

    foreach($cats as $cat) {
        echo '<option value="'.$cat->id.'">'.$sub_mark.$cat->title.'</option>';
        buildCatTable($cat->id, $sub_mark."&nbsp;&nbsp;&nbsp;&nbsp;");
    }
    unset($cats);
    $database->close();
}

function output_buffer($buffer) {

    $headers = apache_request_headers();
    $tt5 = md5($buffer);
    header('ETag: '.$tt5);
    if (
        isset($headers['Accept-Encoding'])
        &&
        in_array('gzip', $headers['Accept-Encoding'])
    ) {
        header('Content-Encoding: gzip');
    }
    if (
        isset($headers['If-None-Match'])
        &&
        $headers['If-None-Match']===$tt5
    ) {
        header('HTTP/1.1 304 Not Modified');
        header('Connection: close');
        exit();
    }
    $buffer = gzencode($buffer);
    return $buffer;
}


/**
 * limit
 * Return the pagination limit.
 *
 * @param null
 * @return int
 */
function limit()
{
    return config("pagination")->perPage;
}

/**
 * offset
 * Return the offset number.
 *
 * @param int
 * @return int
 */
function offset($limit = 1)
{
    return (
        !empty($_GET['page'])
    ) ? (($_GET['page']-1)*$limit) : 0;
}


/**
 * pagination
 * Create pagination links.
 *
 * @param array
 * @return mixed
 */
function pagination(array $options)
{
    $config = config("pagination");
    $config->totalRows = $options["total"];
    $pagination = new pagination;
    $pagination->initialize($config);
    return $pagination->createLinks();
}

/**
 * redirect
 * Redirect to specific url.
 *
 * @param string
 * @return void
 */
function redirect($url = NULL)
{
    if(empty($url)) {
        header("Refresh: 0");
    } else {
        header("Location:".$url);
    }
    exit;
}

/**
 * config
 * Set or get website default configuration.
 *
 * @param string
 * @param boolean
 * @return array
 */
function config($file, $options = false)
{
    $result = include("config/".$file.".php");
    if (
        $options &&
        count($options) > 0
    ){
        $result = array_replace($result, $options);
    }
    return (object) $result;
}


/**
 * base_url
 * Return the website url.
 *
 * @param string
 * @return string
 */
function base_url($url = "")
{
    return (!empty($url)) ? URL."/".$url : URL;
}

/**
 * href
 * Navigate to specific url.
 *
 * @param string
 * @return string
 */
function href($link = "")
{
    return (!empty($link)) ? URL."/".$link : URL;
}

/**
 * secure
 * Remove bad characters.
 *
 * @param mixed
 * @return mixed
 */
function secure($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * settings
 * Return website settings as object.
 *
 * @param null
 * @return object
 */
function settings()
{
    $result = (object) include("includes/settings.php");
    return $result;
}

/**
 * Select
 * Select column data from a table.
 *
 * @param string
 * @param array|string
 * @param string
 * @return object
 */
function select($table, $where = NULL, $orderBy = 'id asc')
{
    $db = database::getInstance();
    return $db->select("*")
    ->from($table)
    ->where($where)
    ->orderBy($orderBy)
    ->get();
}

function getIdInfo($table, $where = NULL, $orderBy = 'id asc')
{
    $db = database::getInstance();
    return $db->select("*")
    ->from($table)
    ->where($where)
    ->orderBy($orderBy)
    ->getOne();
}

?>
