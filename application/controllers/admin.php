<?php
class admin extends controller
{
    function __construct()
    {
        parent::__construct();

        $this->session->start();
        if( !isAdmin() ) {
            exit(self::login());
        }
        $this->load_model("admin");
    }

    function index()
    {
        $data = array();
        $data["title"] = lang()->home;
        $data["orders"] = $this->admin->orders(0,10);
        $data["total_orders"] = statics(TABLE__STATICS, 1)->no_orders;
        $data["total_customers"] = statics(TABLE__STATICS, 1)->no_customers;
        $data["total_sales"] = statics(TABLE__STATICS, 1)->sales;
        $data["total_products"] = statics(TABLE__STATICS, 1)->no_products;
        $data["sales"] = $this->admin->sales();
        $this->view->display($data, array("admin/index"));
    } // End

    function sms()
    {
        $errors = [];
        if ( $this->request->isPost() ) {

            $data = array(
                "provider"   => $this->request->post("provider"),
                "test_token" => $this->request->post("test_token"),
                "live_token" => $this->request->post("live_token"),
                "is_live"    => $this->request->post("is_live")
            );

            foreach ($data as $key => $value) {
                if( empty($value) ) {
                    $errors[] = "{$key} empty field";
                }
            }

            if ( empty($errors) ) {
                $update = $this->admin->update(TABLE__SMS, $data, ["id" => 1]);

                file_put_contents("config/sms.php", '<?php return ' . var_export($data, true) . '; ?>');

                if ( $update ) {
                    $data["msg"] = lang()->updated;
                }
            }

        }
        $data["sms"] = $this->admin->sms();
        $data["errors"] = $errors;
        $this->view->display($data, array("admin/sms"));
    } // End

    function settings()
    {
        $data = array();

        if ( $this->request->isPost() ) {

            $post = array_map("secure", $_POST);
            $this->load_library("upload");

            if( $this->request->hasFile("site_logo") ) {
                @unlink( settings()->site_logo );
            }
            $site_logo = ( empty($_FILES["site_logo"]['tmp_name']) )
            ? settings()->site_logo
            : $this->upload->upload("site_logo")['path'];

            if( $this->request->hasFile("site_icon") ) {
                @unlink( settings()->site_icon );
            }
            $site_icon = ( empty($_FILES["site_icon"]['tmp_name']) )
            ? settings()->site_icon
            : $this->upload->upload("site_icon")['path'];

            $data = array(
                "site_name"          => $this->request->post("site_name"),
                "site_logo"          => $site_logo,
                "site_icon"          => $site_icon,
                "site_keywords"      => $this->request->post("site_keywords"),
                "site_description"   => $this->request->post("site_description"),
                'site_language'      => $this->request->post("site_language"),
                "app_android_link"   => $this->request->post("app_android_link"),
                "app_ios_link"       => $this->request->post("app_ios_link"),
                "timezone"           => $this->request->post("timezone"),
                "google_analytics"   => $this->request->post("google_analytics"),
                "currency"           => "SAR",
                "shipping_amount"    => $this->request->post("shipping_amount")
            );

            foreach ($data as $key => $value) {
                if( empty($value) ) unset($data[$key]);
            }

            $update = $this->admin->update(TABLE__SETTINGS, $data, ["id" => 1]);

            if ( $update ) {

                @file_put_contents('includes/settings.php',
                '<?php return ' . var_export($data, true) . '; ?>'
                );

                $data["msg"] = lang()->updated;
            } else {

            }
        }

        $data["languages"] = $this->database->select("*")
        ->from(TABLE__LANGUAGES)
        ->get();

        $data["settings"] = $this->database->select("*")
        ->from(TABLE__SETTINGS)
        ->getOne();

        $this->view->display($data, array("admin/settings"));
    } // End

    function backup()
    {
        return $this->database->backup("*");
    } // End


    function languages()
    {
        $data = array();
        $errors = array();

        if ( $this->request->isPost() ) {

            $data = array(
                "code"  => $this->request->post("code"),
                "name"  => $this->request->post("name")
            );

            $this->load_library("upload");

            $this->upload->config(array(
                "upload_dir" => "languages",
                "extensions" => array("json"),
                'file_name'  => $data["code"],
                "rename"     => true
            ));

            $uploaded = $this->upload->upload("lang_file");
            $data["path"] = $uploaded["path"];

            if(
                $this
                ->upload
                ->has_error()
            ) {
                $errors[] = $this->upload->errors()[0];
            } else {
                if ( $this->admin->insert(TABLE__LANGUAGES, $data) ) {
                    $data["msg"] = lang()->added;
                }
            }

        }

        $limit = limit();
        $offset = offset($limit);

        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__LANGUAGES)
        ));
        $data["languages"] = $this->admin->languages($offset, $limit);
        $data["errors"] = $errors;
        $this->view->display($data, array("admin/language"));
    } // End


    function customers()
    {
        $data = array();

        $data["title"] = lang()->customers;

        if ( $this->request->isPost() ) {

        }

        $limit = limit();
        $offset = offset($limit);

        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__CUSTOMERS)
        ));
        $data["customers"] = $this->admin->customers($offset, $limit);
        $this->view->display($data, array("admin/customers"));

    } // End

    function orders()
    {
        $data = array();
        $data["title"] = lang()->orders;

        if ( $this->request->isPost() ) {

            $data = array(
                "paid"         => $this->request->post("paid"),
                "order_status" => $this->request->post("order_status")
            );

            $action = $this->request->post("action");

            if ( "update" == $action ) {

                // Order attributes
                $id = intval($this->request->post("order_id"));
                $customerId = intval($this->request->post("customer_id"));
                $total = $this->request->post("total");

                $update = $this->admin->update(TABLE__ORDERS, $data, ["id" => $id]);

                if ( $update ) {

                    if( $data["order_status"] > 0 ) {
                        $_SESSION["totalPendingOrders"] -= 1;
                    }

                    if( $data["order_status"] == 0 ) {
                        $_SESSION["totalPendingOrders"] += 1;
                    }


                    // We have to check if the order completed and paid.
                    if( 1 == $data["paid"] && 5 == $data["order_status"]) {

                        $orderIdPaymentMethod = getIdInfo(TABLE__ORDERS, ["id" => $id])->payment_method;

                        if( "cashOnDelivery" == $orderIdPaymentMethod ) {

                            $data = array(
                                "order_id"        => $id,
                                "customer_id"     => $customerId,
                                "customer_name"   => getIdInfo(TABLE__CUSTOMERS,["id" => $customerId])->username,
                                "transaction_id"  => "N/A",
                                "card_number"     => "N/A",
                                "card_type"       => "N/A",
                                "payment_status"  => "succeeded",
                                "total"           => $total,
                                "created_at"      => date("Y-m-d H:i:s")
                            );
                            $this->database->insert(TABLE__PAYMENTS, $data);

                        }

                    }

                    $data["msg"] = lang()->updated;
                }

            }

        }

        $limit = limit();
        $offset = offset($limit);

        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__ORDERS)
        ));
        $data["orders"] = $this->admin->orders($offset, $limit);
        $this->view->display($data, array("admin/orders"));
    } // End

    function order_details($id = 0)
    {
        if ( empty($id) ) {
            return;
        }

        $data = array();
        $data["title"] = lang()->order_details;

        if ( !empty($id) && $id > 0 ) {
            $id = intval($id);
        }

        $data["orders"] = $this->admin->order_details($id);
        $this->view->display($data, array("admin/order_details"));
    } // End

    function stripe()
    {
        $data = array();
        $data["title"] = lang()->payments;

        if( $this->request->isPost() ) {

            $data = array(
                "stripe_publish_key" => $this->request->post("publish_key"),
                "stripe_secret_key"  => $this->request->post("secret_key")
            );

            $update = $this->admin->update(TABLE__SETTINGS, $data, ["id" => 1]);

            if( $update ) {

                @file_put_contents('config/stripe.php',
                '<?php return ' . var_export($data, true) . '; ?>'
                );

                $data["msg"] = lang()->updated;
            }

        }

        $this->view->display($data, array("admin/stripe"));
    } // End

    function payments()
    {
        $data = array();
        $data["title"] = lang()->payments;

        $limit = limit();
        $offset = offset($limit);

        $data["payments"] = $this->admin->payments($offset, $limit);
        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__PAYMENTS)
        ));
        $this->view->display($data, array("admin/payments"));
    } // End

    function smtp()
    {
        $data = array();
        $data["title"] = lang()->smtp;

        if ($this->request->isPost()) {

            $data = array(
                "smtp_server"   => $this->request->post("smtp_server"),
                "smtp_username" => $this->request->post("smtp_username"),
                "smtp_password" => $this->request->post("smtp_password"),
                "smtp_secure"   => $this->request->post("smtp_secure"),
                "smtp_port"     => $this->request->post("smtp_port")
            );

            file_put_contents("config/smtp.php", '<?php return ' . var_export($data, true) . '; ?>');
            $data["msg"] = lang()->updated;
        }
        $data["smtp"] = (object) require("config/smtp.php");
        $this->view->display($data, array("admin/smtp"));
    } // End

    function logs()
    {
        $data = array();
        $data["title"] = lang()->logs;

        $limit = limit();
        $offset = offset($limit);

        $data["logs"] = $this->admin->logs($offset, $limit);
        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__LOGS)
        ));

        $this->view->display($data, array("admin/logs"));
    } // End

    function categories()
    {
        $data = array();
        $data["title"] = lang()->categories;


        if ( $this->request->isPost() ) {

            if ( $this->request->hasFile("image") ) {
                $this->load_library("upload");
                $this->upload->upload(["upload_dir" => "uploads/categories"]);
                $image = $this->upload->upload("image")["path"];
            } else {
                $image = $this->request->post("category_image_path");
            }

            $data = array(
                "title"     => $this->request->post("category_name"),
                "parent_id" => $this->request->post("sub_category"),
                "image"     => $image,
                "status"    => intval($this->request->post("status"))
            );

            $action = $this->request->post("action");

            if ( "update" == $action ) {

                $id = intval($this->request->post("category_id"));

                $data["updated_at"] = date("Y-m-d H:i:s");

                $update = $this->admin->update(TABLE__CATEGORIES, $data, ["id" => $id]);

                if ( $update ) {
                    $data["msg"] = lang()->updated;
                }

            } elseif ( "insert" == $action ) {
                $data["created_at"] = date("Y-m-d H:i:s");
                $add = $this->admin->insert(TABLE__CATEGORIES, $data);
                if ($add) {
                    $data["msg"] = lang()->added;
                }
            }
        }
        $limit = limit();
        $offset = offset($limit);

        $data["categories"] = $this->admin->categories($offset, $limit);
        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__CATEGORIES)
        ));

        $this->view->display($data, array("admin/categories"));
    } // End

    function products()
    {
        $data = array();
        $data["title"] = lang()->products;
        $data["js_files"] = array("ckeditor/ckeditor");

        if ( $this->request->isPost() ) {

            $this->load_library("upload");
            $this->upload->config(["upload_dir" => "uploads/products"]);

            if ( $this->request->hasFile("product_image") ) {
                $product_image = $this->upload->upload("product_image")['path'];
                if ( $product_image ) {
                    unlink($this->request->post("product_image_default_path"));
                }
            } else {
                $product_image = $this->request->post("product_image_default_path");
            }

            $data = array(
                "product_name"        => $this->request->post("product_name"),
                "product_description" => $this->request->post("product_desc"),
                "product_image"       => $product_image,
                "category_id"         => intval($this->request->post("category")),
                "status"              => intval($this->request->post("status")),
                "size"                => implode(",", $this->request->post("size")),
                "color"               => implode(",", $this->request->post("color")),
                "stock"               => intval($this->request->post("stock")),
                "price"               => $this->request->post("price"),
                "sale"                => $this->request->post("sale"),
                "created_at"          => date("Y-m-d H:i:s")
            );

            $action = $this->request->post("action");

            if ( "update" == $action ) {

                $product_id = intval($this->request->post("product_id"));

                $updateProduct = $this->admin->update(TABLE__PRODUCTS, $data, ["id" => $product_id]);

                if ( $updateProduct ) {

                    if ( $this->request->hasFile("product_images") ) {
                        $product_images = $this->upload->upload("product_images")["path"];
                        if ( $product_images ) {
                            $images = explode(",", $this->request->post("product_images_path"));
                            foreach ($images as $image) {
                                unlink($image);
                            }
                        }
                        if ( is_array($product_images) ) {
                            $product_images = implode(",", $product_images);
                        }
                    } else {
                        $product_images = $this->request->post("product_images_path");
                    }

                    $data = array(
                        "path" => $product_images,
                    );

                    logs(2, $_SESSION["username"]);

                    $this->admin->update(TABLE__PRODUCTS__IMAGES, $data, ["product_id" => $updateProduct]);

                    $data["msg"] = lang()->updated;

                }

            } // End update

            if ( "insert" == $action ) {

                $addNewProduct = $this->admin->insert(TABLE__PRODUCTS, $data);

                if ( $addNewProduct ) {

                    if ( $this->request->hasFile("product_images") ) {

                        $product_images = $this->upload->upload("product_images")['path'];

                        if ( $product_images ) {

                            if ( is_array($product_images) ) {
                                $product_images = implode(",", $product_images);
                            }

                            $data = array(
                                "product_id" => $addNewProduct,
                                "path"       => $product_images,
                            );

                            $this->admin->insert(TABLE__PRODUCTS__IMAGES, $data);
                        }

                    }

                    logs(1, $_SESSION["username"]);

                    $data["msg"] = lang()->added;
                }

            } // End insert

            $data["js_files"] = array("ckeditor/ckeditor");

        }

        $limit = limit();
        $offset = offset($limit);

        $data["products"] = $this->admin->products($offset, $limit);
        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__PRODUCTS)
        ));

        $this->view->display($data, array("admin/products"));
    } // End

    function coupons()
    {
        $data = array();
        $data["title"] = lang()->coupons;

        if( $this->request->isPost() ) {

            $data = array(
                "discount"   => $this->request->post("discount"),
                "valid_from" => $this->request->post("valid_from"),
                "valid_to"   => $this->request->post("valid_to"),
                "type"       => $this->request->post("type"),
                "limited"    => $this->request->post("limited")
            );

            if( "update" == $_POST["action"] ) {

                $id = intval($this->request->post("coupon_id"));
                $data["updated_at"] = date("Y-m-d H:i:s");

                $updateCoupon = $this->admin->update(
                    TABLE_COUPONS,
                    $data,
                    ["id" => $id]
                );

                if ($updateCoupon) {
                    $data["msg"] = lang()->updated;
                }

            }

        }

        $limit = limit();
        $offset = offset($limit);

        $data["coupons"] = $this->admin->coupons($offset, $limit);
        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__COUPONS)
        ));
        $this->view->display($data, array("admin/coupons"));

    } // End

    function media()
    {
        $data = array();
        $data["title"] = lang()->media;

        $limit = limit();
        $offset = offset($limit);
        $data["images"] = $this->admin->media($offset, $limit);
        $data["pagination"] = pagination(array(
            "total" => $this->admin->count(TABLE__PRODUCTS__IMAGES)
        ));

        $this->view->display($data, array("admin/media"));
    } // End

    function reports()
    {
        $data = array();
        $data["title"] = lang()->reports;

        if ( $this->request->isPost() ) {

            //$from = str_replace("/","-", $this->request->post("from"))." 00:00:00";
            //$to   = str_replace("/","-", $this->request->post("to"))." 00:00:00";
            $from = $this->request->post("from");
            $to = $this->request->post("to");
            $data["sales"] = $this->admin->reports($from, $to);
            print_r($data["sales"]);
            return;
        }

        $this->view->display($data, array("admin/reports"));
    } // End


    function download()
    {
        $path = "sample.json";
        header('Content-disposition: attachment; filename="'.$path.'"');
        header('Content-type: application/json');
        header("Content-Length: " . filesize($path));
        readfile($path);
    } // End

    function account()
    {
        $data = array();

        if ( $this->request->isPost() ) {

            $post = array_map("secure", $_POST);
            $current_password = !empty($post['current_password'])
                                ? hash("sha256", $post['current_password'])
                                : '';
            $data = array(
                'username'  => $post['username'],
                'password'  =>  !empty($post['new_password'])
                                ? hash('sha256', $post['new_password'])
                                : ''
            );

            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }

            $password = $this->session->get("password");

            if (
                !empty($post['new_password'])
                && $password != $current_password
            ) {
                $data['msg'] = lang()->password_not_matched;
            } else {

                $id = $this->session->get("id");
                $update = $this->admin->update(TABLE__ADMINS, $data, ["id" => $id]);

                if ( $update ) {
                    foreach ($data as $key => $value) {
                        $this->session->set($key, $value);
                    }
                }
                $data['msg'] = lang()->updated;
            }

        }
        $this->view->display($data, array("admin/account"));
    } //End

    function login()
    {
        $data = array();
        $data["title"] = lang()->login;
        $this->view->display($data, array("admin/login"));
    } // End

    function forget()
    {
        $data = array();
        $data["title"] = lang()->forget;
        $this->view->display($data, array("admin/forget"));
    } // End

    function logout()
    {
        $this->session->destroy();
        redirect(base_url("admin"));
    } // End

}
?>
