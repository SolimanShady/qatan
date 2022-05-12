<?php
require("libraries/payments/vendor/autoload.php");

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

class api extends controller
{

	function __construct()
	{
		parent::__construct();
		$this->load_library("response");
	}

	function index()
	{
		echo "Silence is Gold";
	} // End

	function sms()
	{
	    if( $this->request->isPost() ) {

	        $otp = substr(
            str_shuffle("1234567890abcdefghijklmnpqrstuvwxyz"),0, 4);

	        $phone_number = $this->request->post("phone_number");

	        if( !empty($phone_number) ) {

	            $this->load_library("sms");
	            $this->sms->from( settings()->site_name )
	            ->to(["+$phone_number"])
	            ->body($otp)
	            ->send();

	            if( $this->sms->sent() ) {


	               $this->database->update(TABLE__CUSTOMERS,
	               ["otp" => $otp],
	               ["phone" => $phone_number]);

	                $this->response->status(200);
	            } else {
	                $this->response->status(400);
	            }

	        }
	    }
	} // End


	function otp()
	{
	    if( $this->request->isPost() ) {

	        $phone_number = intval($this->request->post("phone_number"));
	        $otp = $this->request->post("otp");

	        if( !empty($phone_number) && !empty($otp) ) {

	            $checkUserOtp = $this->database->select("*")
	            ->from(TABLE__CUSTOMERS)
	            ->where([
	                "otp"   => $otp,
	                "phone" => $phone_number
	           ])
	            ->getOne();

	            if( $checkUserOtp ) {

	                $this->database->update(TABLE__CUSTOMERS,
	                ["verified" => 1, "otp" => ""],
	                ["phone" => $phone_number]);

	                $this->response->status(200);
	            } else {
	                $this->response->status(400);
	            }

	        }

	    }
	} // End

	function update_password()
	{
	    if( $this->request->isPost() ) {

	        $phone_number = $this->request->post("phone_number");
	        $new_password = hash("sha256", $this->request->post("password"));

	        if( !empty($phone_number) && !empty($new_password) ) {

	            $updatePassword = $this->database->update(TABLE__CUSTOMERS,
	            ["password" => $new_password],
	            ["phone" => $phone_number]);

	            if( $updatePassword ) {
	                $this->response->status(200);
	            } else {
	                $this->response->status(400);
	            }

	        }

	    }
	} // End

	function orders()
	{
	    if( $this->request->isPost() ) {


	       $ids = trim($this->request->post("ids"), "][}{");
	       $quantity = trim($this->request->post("quantity"), "][}{");
	       $color = trim($this->request->post("color"), "][}{");
	       $size = trim($this->request->post("size"), "][}{");
	       $price = trim($this->request->post("price"), "][}{");

	       $ids_array = explode(",", $ids);
	       $quantity_array = explode(",", $quantity);
	       $prices_array = explode(",", $price);
	       $size_array = explode(",", $size);
	       $colors_array = explode(",", $color);

	        $data = array(
	            "customer_id"       => intval($this->request->post("customer_id")),
	            "payment_method"    => $this->request->post("payment_method"),
	            "shipping_location" => $this->request->post("shipping_location"),
	            "total"             => $this->request->post("total"),
	            "notes"             => $this->request->post("notes"),
	            "created_at"        => date("Y-m-d H:i:s")
	       );

	       $makeNewOrder = $this->database->insert(TABLE__ORDERS, $data);

	       if( $makeNewOrder ) {

	           $ids = trim($this->request->post("ids"), "][}{");
	           $quantity = trim($this->request->post("quantity"), "][}{");
	           $color = trim($this->request->post("color"), "][}{");
	           $size = trim($this->request->post("size"), "][}{");
	           $price = trim($this->request->post("price"), "][}{");

	           $i = 0;
	           $length = count($ids_array);
	           for($i; $i<$length;$i++)
	           {
	               $this->database->insert(TABLE__ORDER__DETAILS, [
	                   "order_id"    => $makeNewOrder,
	                   "customer_id" => $data["customer_id"],
	                   "product_id"  => $ids_array[$i],
	                   "color"       => $colors_array[$i],
	                   "size"        => $size_array[$i],
	                   "price"       => $prices_array[$i],
	                   "quantity"    => $quantity_array[$i],
	                   "total"       => ($prices_array[$i] * $quantity_array[$i]),
	                   "created_at"  => date("Y-m-d H:i:s")
	               ]);
	           }

	           if( "card" == $data["payment_method"] ) {

	               $order_id = $makeNewOrder;
	               $customer_id = $data["customer_id"];

	               $this->payments($order_id, $customer_id);
	           }
	           $this->response->status(200);
	       } else {
	           $this->response->status(400);
	       }
	    }
	} // End


	function orders_list()
	{

		if ( $this->request->isPost() ) {

			$customerId = intval($this->request->post("customer_id"));
			$filter = !empty($this->request->post("filter"))
			? $this->request->post("filter")
			: "";

			// IF filter exists
			if ( !empty($filter) ) {

				$data = $this->database->select("*")
				->from(TABLE__ORDERS)
				->where([
					"customer_id" => $customerId,
					"paid"        => $filter
				])
				->get();

				if ( $data ) {
					$this->response->status(200)->json(["data" => $data]);
				} else {
					$this->response->status(400);
				}

			} else {

				$data = $this->database->select("*")
				->from(TABLE__ORDERS)
				->where(["customer_id" => $customerId])
				->orderBy("id desc")
				->get();

				if ( $data ) {
					$this->response->status(200)->json(["data" => $data]);
				} else {
					$this->response->status(200)->json(["data" => array()]);
				}
			}

		}
	} // End

	function payments($order_id, $customer_id)
	{

	    $customerId = intval($this->request->post("customer_id"));

	    $customer = getIdInfo(TABLE__CUSTOMERS, ["id" => $customerId]);

        $data = array(
            "order_id"      => $order_id,
            "customer_id"   => intval($this->request->post("customer_id")),
            "customer_name" => $customer->username,
            "card_number"   => $this->request->post("card_number"),
            "card_type"     => getCreditCardType($this->request->post("card_number")),
            "cvc"           => $this->request->post("cvc"),
            "exp_month"     => $this->request->post("exp_month"),
            "exp_year"      => $this->request->post("exp_year"),
            "total"         => $this->request->post("total"),
            "created_at"    => date("Y-m-d H:i:s")
       );


        $stripe = new \Stripe\StripeClient(config("stripe")->stripe_secret_key);

        // Generate Token
        $card_token =  $stripe->tokens->create([
          'card' => [
            'number'    => $data["card_number"],
            'exp_month' => $data["exp_month"],
            'exp_year'  => $data["exp_year"],
            'cvc'       => $data["cvc"],
          ],
        ]);


        // Create new customer
        $_customer = $stripe->customers->create([
            "email"  => $customer->email,
            "source" => $card_token,
            "name"   => $customer->username,
            "address" => array(
                "line1"       => $customer->location,
                "postal_code" => "",
                "city"        => $customer->city,
                "state"       => $customer->region,
                "country"     => "Egypt"
            )
        ]);


        //$order_number = rand(100000,999999);
        $order_number = $data["order_id"];

        //Create card token
        $charge = $stripe->charges->create([
            "customer"    => $_customer->id,
            "amount"      => $data["total"] * 100,
            "currency"    => strtoupper(settings()->currency),
            "description" => 'Payment for order '.$order_number,
            //"source" => $card_token,
            "metadata" => array(
                "order_id" => $order_number
            )
        ]);

        $response = $charge->JsonSerialize();

        if(
            $response['amount_refunded'] == 0
            && empty($response['failure_code'])
            && $response['paid'] == 1
            && $response['captured'] == 1
            && $response['status'] == 'succeeded'
        )
        {
            $data["	transaction_id"] = $response["balance_transaction"];
            $data["payment_status"] = $response["status"];
            unset($data["cvc"],$data["exp_month"], $data["exp_year"]);

            $data["card_number"] = substr_replace( $this->request->post("card_number"), "************",0,12 );
            $payments = $this->database->insert(TABLE__PAYMENTS, $data);

	       if( $payments ) {
	           $this->database->update(TABLE__ORDERS,
	           ["paid" => 1],["id" => $data["order_id"]]);
	           $this->response->status(200);
	       } else {
	           $this->response->stauts(400);
	       }


        }

	} // End

	function shipping()
	{
	    if( $this->request->isGet() ) {
	        $this->response->status(200)->json(["data" => settings()->shipping_amount]);
	    }
	} // End


	function profile()
	{
	    if( $this->request->isPost() ) {

	        $userId = intval($this->request->post("user_id"));

	        if( !empty($userId) ) {

	            $data = $this->database->select("*")
	            ->from(TABLE__CUSTOMERS)
	            ->where(["id" => $userId])
	            ->getOne();

	            if( $data ) {
	                $this->response->status(200)->json(["data" => $data]);
	            } else {
	                $this->response->status(400);
	            }

	        }

	    }
	} // End

	function edit_profile()
	{
	    if( $this->request->isPost() ) {

	        $customerId = intval($this->request->post("customer_id"));

	        if( empty($customerId) ) return;

	        if( $this->request->hasFile("profile") ) {
	            $this->load_library("upload");
	            $this->upload->config(["upload_dir" => "uploads/customers"]);
	            $profile = $this->upload->upload("profile")["path"];
	        }

	        $data = array(
	            "username" => $this->request->post("username"),
	            "location" => $this->request->post("location"),
	            "profile"  => $profile
	       );

	       foreach($data as $key => $value) {
	           if( empty($value) ) unset($data[$key]);
	       }

	       $updateProfile = $this->database->update(TABLE__CUSTOMERS, $data, ["id" => $customerId]);

	       if( $updateProfile ) {

	           $data = $this->database->select("*")
	           ->from(TABLE__CUSTOMERS)
	           ->where(["id" => $customerId])
	           ->getOne();

	           $this->response->status(200)->json(["data" => $data]);

	       } else {

	           $this->response->status(400);

	       }

	    }
	} // End

	function create_order()
	{
		if ( $this->request->isPost() ) {

			$customerId = intval($this->request->post("customer_id"));

			if( empty($customerId) ) return;

			$data = array(
				"customer_id"       => $customerId,
				"payment_method"    => $this->request->post("payment_method"),
				"shipping_location" => $this->request->post("shipping_location"),
				"total"             => $this->request->post("total"),
				"notes"             => $this->request->post("notes")
			);

			$newOrder = $this->database->insert(TABLE__ORDERS, $data);
			if ( $newOrder ) {
				$this->response->status(200);
			} else {
				$this->response->status(400);
			}

		}
	} // End

	function categories()
	{
		if ( $this->request->isGet() ) {

			$categories = $this->database->select("*")
			->from(TABLE__CATEGORIES)
			->where([
			    "parent_id" => 0,
			    "status" => 1
			 ])
			->orderBy("id desc")
			->get();


			if ( $categories ) {
				$this->response->status(200)->json(["data" => $categories]);
			} else {
				$this->response->status(200)->json(["data" => array()]);
			}
		}

	} // End

	function category_list()
	{
		if ( $this->request->isGet() ) {

			$categories = $this->database->select("*")
			->from(TABLE__CATEGORIES)
			->orderBy("id desc")
			->get();

			if ( $categories ) {
				$this->response->status(200)->json(["data" => $categories]);
			} else {
				$this->response->status(200)->json(["data" => array()]);
			}
		}

	} // End


	function category_products()
	{
	    if( $this->request->isPost() ) {

	        $categoryId = intval($this->request->post("category_id"));

	        $categoryIds = (array) $this->database->select([
	            "b.id",
	            "b.parent_id"
	       ])
	        ->from(TABLE__CATEGORIES." a ")
	        ->join(TABLE__CATEGORIES." b ", "INNER")
	        ->where([
	            "a.id" => $categoryId,
	            "b.parent_id" => $categoryId
	        ])
	        ->getOne();

	       if( empty($categoryIds) ) {
	           $categoryIds = 1;
	           $cats = $categoryId;
	       } else {
	           $cats = implode(",", $categoryIds);
	       }

	        /*
	        $cats = array();
	        foreach( $categoryIds as $cat) {
	            $cats []= $cat->id;
	            $cats[] = $cat->parent_id;
	        }*/

	        if( $categoryIds ) {

	            //$cats = implode(",", $categoryIds);

	            $products = $this->database->select("*")
	            ->from(TABLE__PRODUCTS)
	            ->where("category_id IN($cats)")
	            ->get();

	            if( $products ) {

	                foreach($products as $product) {
        			    $product->rate = product_rate($product->id);
        			    $product->discount = product_discount($product);
			        }

	                $this->response->status(200)->json(["data" => $products]);

	            } else {
	                $this->response->status(200)->json(["data" => array()]);
	            }

	        }


	    }
	} // End


	function sub_category()
	{
	    if( $this->request->isPost() ) {

	        $categoryId = intval($this->request->post("category_id"));

	        if( empty($categoryId) ) return;

	        $data = $this->database->select("*")
	        ->from(TABLE__CATEGORIES)
	        ->where([
	            "parent_id" => $categoryId,
	            "status"    => 1
	       ])
	        ->get();

	        if( $data ) {
	            $this->response->status(200)->json(["data" => $data]);
	        } else {
	            $this->response->status(200)->json(["data" => array()]);
	        }
	    }
	} // End

	function sub_category_products()
	{
	    if( $this->request->isPost() ) {

	        $subCategoryId = intval($this->request->post("sub_cat_id"));

	        if( empty($subCategoryId) ) return;

	        $data = $this->database->select("*")
	        ->from(TABLE__PRODUCTS)
	        ->where(["category_id" => $subCategoryId])
	        ->get();

	        if( $data ) {

	            foreach($data as $d) {
			        $d->rate = product_rate($d->id);
		    	}

	            $this->response->status(200)->json(["data" => $data]);
	        } else {
	            $this->response->status(200)->json(["data" => array()]);
	        }


	    }
	} // End

	function products()
	{
		if ( $this->request->isGet() ) {


		    $products = $this->database->select("*")
			    ->from(TABLE__PRODUCTS)
			    ->where("stock > 0 and sale = 0 and status = 1")
			    ->orderBy("id desc")
			    ->get();

			if ( $products ) {

			    foreach($products as $product) {
    			    $product->rate = product_rate($product->id);
    			    $product->discount = product_discount($product);
			    }

				$this->response->status(200)->json(["data" => $products]);
			} else {
				$this->response->status(200)->json(["data" => array()]);
			}
		}

	} // End


	function product()
	{
		if ( $this->request->isPost() ) {

			$productId = intval($this->request->post("product_id"));

			if( empty($productId) ) return;

			$product = $this->database->select([
                    "*",
                    TABLE__PRODUCTS.".id",
                ])
                ->from(TABLE__PRODUCTS)
                ->join(TABLE__PRODUCTS__IMAGES, "LEFT")
                ->on(
                    TABLE__PRODUCTS__IMAGES.".product_id",
                    TABLE__PRODUCTS.".id"
                )
                ->where([TABLE__PRODUCTS.".id" => $productId])
                ->getOne();

			if ( $product ) {

			    $product->rate = product_rate($product->id);
    			$product->size = explode(",", $product->size);
    			$product->color = explode(",", $product->color);
    			$product->images = explode(",", $product->path);

				$this->response->status(200)->json(["data" => $product]);
			} else {
				$this->response->status(400);
			}
		}

	} // End

	function offers()
	{
	    if( $this->request->isGet() ) {

	        $products = $this->database->select("*")
    	        ->from(TABLE__PRODUCTS)
    	        ->where("sale > 0")
    	        ->orderBy("id desc")
    	        ->get();

	        if( $products ) {

	            foreach($products as $product) {
    			    $product->discount = product_discount($product);

			    }

	            $this->response->status(200)->json(["data" => $products]);
	        } else {
	            $this->response->status(200)->json(["data" => array()]);
	        }

	    }
	} // End

	function featured()
	{
		if ( $this->request->isGet() ) {

			$data = $this->database->select("*")
			->from(TABLE__PRODUCTS)
			->where(["featured" => 1])
			->orderBy("id desc")
			->get();

			if ( $data ) {
				$this->response->status(200)->json(["data" => $data]);
			} else {
				$this->response->status(200)->json(["data" => array()]);
			}
		}
	} // End

	function ratings()
	{
		if ( $this->request->isPost() ) {

			$productId = intval($this->request->post("product_id"));

			if( !empty($productId) ) {

			    $data = $this->database->select("*")
    			->from(TABLE__RATINGS)
    			->where(["product_id" => $productId])
    			->get();

    			if ( $data ) {
    				$rating = "";
    				$this->response->status(200)->json(["data" => $rating]);
    			}

			}

		}
	} // End

	function rate()
	{
		if ( $this->request->isPost() ) {

			$productId  = intval($this->request->post("product_id"));
			$rate       = intval($this->request->post("rate"));

			if ( !empty($productId) && !empty($rate) ) {

			    $total_users_rated = 1;
			    $total_ratings     = $rate;

			    $data = array(
					"product_id"        => $productId,
					"total_ratings"     => $total_ratings,
					"total_users_rated" => $total_users_rated
				);

				// Get product rating details
				$product = $this->database->select("*")
				->from(TABLE__RATINGS)
				->where(["product_id" => $productId])
				->getOne();

				if( !$product ) {
				    $rateProduct = $this->database->insert(TABLE__RATINGS, $data);
				} else {
				    $data["total_users_rated"] = ($product->total_users_rated) + 1;
				    $data["total_ratings"]     = ($product->total_ratings) + $rate;

				    $rateProduct = $this->database->update(TABLE__RATINGS, $data, ["product_id" => $productId]);
				}


				if ( $rateProduct ) {
					$this->response->status(200);
				} else {
					$this->response->status(400);
				}

			}

		}
	} // End

	function reviews()
	{
		if ( $this->request->isPost() ) {

			$productId = intval($this->request->post("product_id"));
			$customerId = intval($this->request->post("customer_id"));
			$review = $this->request->post("review");

			if( !empty($productId) && !empty($customerId) && !empty($review) ) {

			    $data = array(
			        "customer_id"=> $customerId,
			        "product_id" => $productId,
			        "review"     => $review,
			        "created_at" => date("Y-m-d H:i:s")
			     );

			    $addReview = $this->database->insert(TABLE__REVIEWS, $data);

			    if( $addReview ) {
			        $this->response->status(200);
			    } else {
			        $this->response->status(400);
			    }

			}

			if( empty($review) && empty($customerId) && !empty($productId) ) {

			    $data = $this->database->select("*")
			    ->from(TABLE__REVIEWS)
			    ->where(["product_id" => $productId])
			    ->orderBy("id desc")
			    ->get();

			    foreach($data as $d) {
			        $customer_info = getIdInfo(TABLE__CUSTOMERS, ["id" => $d->customer_id]);
			        $d->customer_name = $customer_info->username;
			        $d->customer_image = $customer_info->profile;
			    }

			    if( $data ) {
			        $this->response->status(200)->json(["data" => $data]);
			    } else {
			        $this->response->status(200)->json(["data" => array()]);
			    }

			}


		}
	} // End

	function favourites()
	{
		if( $this->request->isPost() ) {

			$data = array(
				"customer_id"  => $this->request->post("customer_id"),
				"product_id"   => $this->request->post("product_id"),
				"is_favourite" => intval($this->request->post("is_favourite"))
		   );

			if( !empty($data["customer_id"]) &&	!empty($data["product_id"]) ) {

				$checkProduct = $this->database->select("*")
				->from(TABLE__FAVOURITES)
				->where([
				   "customer_id" => $this->request->post("customer_id"),
				   "product_id"  => $this->request->post("product_id")
			   ])->getOne();

			   if( $checkProduct )  {

				   $removeOrAddToFavouriteList = $this->database->update(
				   			TABLE__FAVOURITES,
							$data, [
								"customer_id"  => $this->request->post("customer_id"),
								"product_id"   => $this->request->post("product_id"),
					   ], 1);

				   if( $removeOrAddToFavouriteList ) {
						$this->response->status(200);
					}

			   } else {
				   $addToFavouriteList = $this->database
				   ->set($data)
				   ->insert(TABLE__FAVOURITES);
					if( $addToFavouriteList ) {
						$this->response->status(200);
					}
			   }

			}

		}

	} // End

	function favourite_list()
	{
	    if( $this->request->isPost() ) {

	        $customerId = intval($this->request->post("customer_id"));

	        if( !empty($customerId) ) {

	            $data = $this->database->select("*")
	            ->from(TABLE__FAVOURITES)
	            ->where(["customer_id" => $customerId])
	            ->get();

	            if( $data ) {
	                $this->response->status(200)->json(["data" => $data]);
	            } else {
	                $this->response->status(200)->json(["data" => array()]);
	            }

	        }

	    }
	} // End

	function search()
	{
	    if( $this->request->isPost() ) {

	        $data = array();

	        $product_name = $this->request->post("product_name");
	        $size = $this->request->post("size");
	        $categoryId = intval($this->request->post("category_id"));

	        if( !empty($product_name) ) $data["product_name"] = $product_name;
	        if( !empty($size) ) $data["size"] = $size;
	        if( !empty($categoryId) ) $data["category_id"] = $categoryId;

	        $data = $this->database->select("*")
	        ->from(TABLE__PRODUCTS)
	        ->Like($data)
	        ->get();

	        if( $data ) {
	            $this->response->status(200)->json(["data" => $data]);
	        } else {
	            $this->response->status(200)->json(["data" => array()]);
	        }

	    }
	} // End


	function register()
	{
		if ( $this->request->isPost() ) {

			$data = array(
				"username"   => $this->request->post("username"),
				"password"   => hash("sha256", $this->request->post("password")),
				"email"      => $this->request->post("email"),
				"phone"      => $this->request->post("phone"),
				"city"       => $this->request->post("city"),
				"region"     => $this->request->post("region"),
				"location"   => $this->request->post("location"),
				"created_at" => date("Y-m-d H:i:s")
			);

			$newCustomer = $this->database->insert(TABLE__CUSTOMERS, $data);

			if ( $newCustomer ) {

				$data = $this->database->select("*")
				->from(TABLE__CUSTOMERS)
				->where(["id" => $newCustomer])
				->getOne();
				$this->response->status(200)->json(["data" => $data]);
                
			} else {
				$this->response->status(400);
			}
		}
	} // End

	function login()
	{
		if( $this->request->isPost() ) {

			$data = array(
				"username" => $this->request->post("username"),
				"password" => hash("sha256", $this->request->post("password")),
				//"verified" => 1
			);

			$login = $this->database->select("*")
			->from(TABLE__CUSTOMERS)
			->where($data)
			->getOne();

			if( $login ) {
				$this->response->status(200)->json(["data" => $login]);
			} else {
				$this->response->status(400);
			}

		}
	} // End

}

?>
