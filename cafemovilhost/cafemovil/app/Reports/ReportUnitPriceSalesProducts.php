<?php
//MyReport.php
namespace App\Reports;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;

class ReportUnitPriceSalesProducts extends \koolreport\KoolReport
{
    //We leave this blank to demo only
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "sales"=>array(
                    "connectionString"=>"mysql:host=localhost;dbname=cafemovildb",
                    "username"=>"root",
                    "password"=>"",
                    "charset"=>"utf8"
                )
            )
        );
    }

    public function setup()
    { 
        $id_school =  $this->params['id_school'];
        $this->src('sales')
        ->query("SELECT products.id_at_store,products.name AS name,unit_price, orders_details.id AS detail FROM products JOIN sellers ON products.id_seller = sellers.id JOIN orders_details ON products.id = orders_details.id_product WHERE sellers.id_school = $id_school AND products.status = true")
        ->pipe(new Group(array(
            "by"=>"name","id_at_store",
            "by"=>"name",
            "by"=>"unit_price",
            "count"=>"detail"
        )))
        ->pipe(new Sort(array(
            "unit_price"=>"desc"
        )))
        ->pipe($this->dataStore('products'));
    
    }
}