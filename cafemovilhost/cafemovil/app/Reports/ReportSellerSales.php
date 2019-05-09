<?php
//MyReport.php
namespace App\Reports;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;

class ReportSellerSales extends \koolreport\KoolReport
{
    //We leave this blank to demo only
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "sales"=>array(
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
        $id_seller =  $this->params['id_seller'];
        $this->src('sales')
        ->query("SELECT products.name as product_name,orders_details.import as import FROM products JOIN orders_details ON products.id = orders_details.id_product WHERE orders_details.id_seller = $id_seller AND orders_details.status = true ")
        ->pipe(new Group(array(
            "by"=>"product_name",
            "sum"=>"import"
        )))
        ->pipe(new Sort(array(
            "import"=>"desc"
        )))
        ->pipe($this->dataStore('sales'));
    }
}