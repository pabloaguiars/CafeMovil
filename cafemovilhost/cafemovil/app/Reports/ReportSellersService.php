<?php
//MyReport.php
namespace App\Reports;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;

class ReportSellersService extends \koolreport\KoolReport
{
    //We leave this blank to demo only
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "orders"=>array(
                    "connectionString"=>env('DB_CONNECTION').":host=".env('DB_HOST').";dbname=".env('DB_DATABASE'),
                    "username"=>env('DB_USERNAME'),
                    "password"=>env('DB_PASSWORD'),
                    "charset"=>"utf8"
                )
            )
        );
    }

    public function setup()
    { 
        $id_school =  $this->params['id_school'];
        $this->src('orders')
        ->query("SELECT orders.status,orders.id AS quantity FROM orders JOIN orders_details ON orders_details.id_order = orders.id JOIN sellers ON orders_details.id_seller = sellers.id WHERE sellers.id_school = $id_school")
        ->pipe(new Group(array(
            "by"=>"quantity",
        )))
        ->pipe(new Group(array(
            "by"=>"status",
            "count"=>"quantity"
        )))
        ->pipe($this->dataStore('orders'));
    }
}