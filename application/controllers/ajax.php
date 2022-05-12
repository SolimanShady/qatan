<?php
class ajax extends controller
{
    function __construct()
    {
        parent::__construct();

        $this->session->start();
        if( !$this->request->isAjax() ) {
            exit("Not allowed !");
        }
        $this->load_library("response");
    }

    function index(){}

    function login()
    {
        if( $this->request->isPost() ) {

            $data = array(
                "username" => base64_decode($this->request->post("username")),
                "password" => hash("sha256", base64_decode( $this->request->post("password") ))
            );

            $login = $this->database->select("*")
            ->from(TABLE__ADMINS)
            ->where($data)
            ->getOne();

            if ( $login ) {

                $this->session->regenerate();

                foreach ($login as $key => $value) {
                    $this->session->set($key, $value);
                }

                $totalPendingOrders = $this->database->select([
                    "count(id) as total"
                ])
                ->from(TABLE__ORDERS)
                ->where(["order_status" => 0])
                ->getOne();

                $lastOrderId = $this->database->select([
                    "id",
                ])
                ->from(TABLE__ORDERS)
                ->where(["order_status" => 0])
                ->orderBy("created_at DESC")
                ->limit(1)
                ->getOne();

                $this->session->set("is_admin", 1);
                $this->session->set("totalPendingOrders", $totalPendingOrders->total);
                $this->session->set("last_order_id", $lastOrderId->id);

                // Save the activity log into database
                logs(4, $this->session->get("username"));

                echo json_encode(["message" => "ok"]);

            } else {
                echo json_encode(["message" => lang()->login_failed]);
            }

        }


    } // End

    function orders()
    {
        if( $this->request->isGet() ) {

            $new_order = $this->database->select("id")
            ->from(TABLE__ORDERS)
            ->orderBy("id desc")
            ->limit(1)
            ->getOne();

            if( $new_order ) {
                $this->response->status(200)->json(["data" => 1]);
            }

        }
    }

    function get_data_id()
   {
       $result = false;
       $uid = $this->session->get("id");
       if(
           !empty($uid)
           && $uid > 0
           && !empty($_GET)
       )
       {
           $id = intval($this->request->get("id"));
           $table = $this->request->get("table");

           if(TABLE__PRODUCTS == $table && $id > 0) {

               $result = $this->database->select([
                   "*",
                   TABLE__PRODUCTS.".id",
                   TABLE__PRODUCTS__IMAGES.".path as images"
               ])
               ->from($table)
               ->join(
                   TABLE__PRODUCTS__IMAGES,
                   "LEFT"
               )
               ->on(
                   TABLE__PRODUCTS.".id",
                   TABLE__PRODUCTS__IMAGES.".product_id"
               )
               ->where([TABLE__PRODUCTS.".id" => $id])
               ->getOne();

           } else {

               if ($id > 0) {
                   $result = $this->database->select("*")
                   ->from($table)
                   ->where(["id" => $id])
                   ->getOne();
               }

           }
       }
       exit(
           json_encode($result)
       );
   } // End


    function forgetPassword()
    {
        $data = array();

        if ( $this->request->isPost() ) {

            $checkUser = $this->database->select("*")->from(TABLE__ADMINS)
            ->where(["email" => $email])
            ->getOne();

            if ( $checkUser ) {

                $otp = substr(str_shuffle("0123456789"), 0, 4);

                $update = $this->database->set(["otp" => $otp])
                ->where(["email" => $email])
                ->update($table);

                $this->load_library("smtp");
                $this->smtp->to($email);
                $this->smtp->subject("Password Update Request");
                $this->smtp->body(
                'Dear '.$checkUser->username.',
                <br/>Recently a request was submitted to reset a password for your account. If this was a mistake,
                just ignore this email and nothing will happen.
                <br/>To reset your password, copy this code <h2>'.$otp.'</h2>');

                if ( $this->smtp->send() ) {
                    echo json_encode([
                        "status" => 200,
                        "message" => lang()->otp_sent
                    ]);
                }
            } else {
                echo json_encode([
                    "status" => 200,
                    "message" => lang()->email_notfound
                ]);
            }

        }
    }

    function generateCoupon()
    {
        echo substr(
            str_shuffle("1234567890abcdefghijklmnpqrstuvwxyz"),0, 8
        );
    } // End

    function delete()
    {
        $uid = $this->session->get("id");
        if(
            !empty($uid)
            && $uid > 0
            && !empty($_POST)
            && strlen($_POST["ids"]) > 0
        )
        {

            $ids = $this->request->post("ids");
            $table = $this->request->post("table");

            // We have to delete language file to free up space.
           if( TABLE__LANGUAGES == $table ) {
               if( strlen($ids) > 0 ) {
                   foreach ( Select(TABLE__LANGUAGES, "id IN($ids)") as $key => $value) {
                       @unlink( $value->path );
                   }
               }
           }

            if ( TABLE__PRODUCTS__IMAGES == $table ) {

                $data = $this->database->select("path")
               ->from(TABLE__PRODUCTS__IMAGES)
               ->where("id IN (".$ids.")")
               ->get();

               if ( $data ) {
                   $images = explode(",", $data[0]->path);

                   foreach ($images as $image) {
                       unlink( $image );
                   }
               }


            }

            $delete = $this->database->where("id IN(".$ids.")")->delete($table);

            if( $delete ) {

                logs(3, "id from $table");

                exit(
                    json_encode([
                        "status" => 200,
                        "msg" => lang()->deleted
                    ])
                );
            }

        }
    } // End

    function getOrders()
    {
        $orders = $this->database->select([
            "*",
            "UNIX_TIMESTAMP(created_at) as time"
        ])
        ->from(TABLE__ORDERS)
        ->where(["order_status" => 0])
        ->orderBy("created_at DESC")
        ->limit(1)
        ->getOne();

        $date = new DateTime;
        $timestamp = $date->getTimestamp();

        if (
            $orders->time > $timestamp
            &&
            $orders->id != $this->session->get("last_order_id")
        ) {

            $this->session->set("last_order_id", $orders->id);
            $_SESSION["totalPendingOrders"] += 1;
            echo json_encode(["data" => $orders]);

        } else {
            echo json_encode(["data" => array()]);
        }

    }


}
?>
