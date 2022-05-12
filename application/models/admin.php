<?php
class _admin extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function login($data)
    {
        return $this->database->select_distinct("*")
        ->from(TABLE__USERS)
        ->where($data)
        ->limit(1)
        ->getOne();
    }

    function settings()
    {
        return $this->database->select("*")
        ->from(TABLE__SETTINGS)
        ->where(["id" => 1])
        ->limit(1)
        ->getOne();
    }

    function sms()
    {
        return $this->database->select("*")
        ->from(TABLE__SMS)
        ->where(["id" => 1])
        ->getOne();
    }

    function orders($offset, $limit)
    {
        return $this->database->select("*")
        ->from(TABLE__ORDERS)
        ->orderBy("id desc")
        ->limit($offset, $limit)
        ->get();
    }

    function totalPendingOrders()
    {
        $total = $this->database->select([
            "count(id) as total"
        ])
        ->from(TABLE__ORDERS)
        ->where(["order_status" => 0])
        ->getOne();

        return $total->total;
    }

    function order_details($id)
    {
        $id = intval($id);
        return $this->database->select("*")
        ->from(TABLE__ORDER__DETAILS)
        ->where(["order_id" => $id])
        ->get();
    }

    function payments($offset, $limit)
    {
        return $this->database->select("*")
        ->from(TABLE__PAYMENTS)
        ->where(["payment_status" => "succeeded"])
        ->orderBy("id desc")
        ->limit($offset, $limit)
        ->get();
    }

    function sales()
    {
        return $this->database->select([
            "sum(total) as total",
            "cast(created_at as date) as date"
        ])
        ->from(TABLE__PAYMENTS)
        ->groupBy("date")
        ->limit(31)
        ->get();
    }

    function reports($from = false, $to = false)
    {
        return $this->database->select([
            "sum(total) as total",
            "cast(created_at as date) as date"
        ])
        ->from(TABLE__PAYMENTS." a")
        ->where("cast(created_at as datetime)")
        ->between("convert($from, datetime)", "convert($to, datetime)")
        ->groupBy("date")
        ->limit(31)
        ->get();
    }

    function customers($offset, $limit)
    {
        return $this->database->select("*")
        ->from(TABLE__CUSTOMERS)
        ->orderBy("id desc")
        ->limit($offset, $limit)
        ->get();
    }


    function categories($offset, $limit)
    {
        return $this->database->select("*")
        ->from(TABLE__CATEGORIES)
        ->orderBy("parent_id, id desc")
        ->limit($offset, $limit)
        ->get();
    }

    function products($offset, $limit)
    {
        return $this->database->select([
            "*",
            TABLE__PRODUCTS.".id"
        ])
        ->from(TABLE__PRODUCTS)
        ->join(TABLE__PRODUCTS__IMAGES, "LEFT")
        ->on(
            TABLE__PRODUCTS__IMAGES.".product_id",
            TABLE__PRODUCTS.".id"
        )
        ->orderBy(TABLE__PRODUCTS.".id desc")
        ->limit($offset, $limit)
        ->get();
    }

    function coupons($offset, $limit)
    {
        return $this->database->select("*")
        ->from(TABLE__COUPONS)
        ->orderBy("id desc")
        ->limit($offset, $limit)
        ->get();
    }


    function media($offset, $limit)
    {
        return $this->database->select_distinct([
	            "*",
	            TABLE__PRODUCTS__IMAGES.".path",
                TABLE__PRODUCTS__IMAGES.".id"
	        ])
	        ->from(TABLE__PRODUCTS)
            ->join(TABLE__PRODUCTS__IMAGES, "LEFT")
            ->on(
                TABLE__PRODUCTS__IMAGES.".product_id",
                TABLE__PRODUCTS.".id"
            )
            ->where([
                "status" => 1
            ])
            ->orderBy(TABLE__PRODUCTS__IMAGES.".id desc")
            ->get();
    }

    function logs($offset, $limit)
    {
        return $this->database->select("*")
        ->from(TABLE__LOGS)
        ->orderBy("id desc")
        ->limit($offset, $limit)
        ->get();
    }

    function languages($offset, $limit)
    {
        return $this->database->select("*")
        ->from(TABLE__LANGUAGES)
        ->orderBy("id desc")
        ->limit($offset, $limit)
        ->get();
    }

    function error()
    {
        return $this->database->error();
    }


    // start generic operations
    function insert($table, array $data)
    {
        return $this->database->set($data)->insert($table);
    }

    function update($table, array $data, $where)
    {
        return $this->database->set($data)
        ->where($where)
        ->update($table);
    }

    function delete($table, $id)
    {
        return $this->database->where("id IN($id)")->delete($table);
    }

    function count($table)
    {
        return $this->database->count($table);
    }

}
?>
