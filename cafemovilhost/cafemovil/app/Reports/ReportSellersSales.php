<?php
//MyReport.php
namespace App\Reports;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;

class ReportSellersSales extends \koolreport\KoolReport
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
        $id_school =  $this->params['id_school'];
        $this->src('sales')
        ->query("SELECT sellers.email as email,orders_details.import as import FROM sellers JOIN orders_details ON sellers.id = orders_details.id_seller WHERE sellers.id_school = $id_school AND orders_details.status = true")
        ->pipe(new Group(array(
            "by"=>"email",
            "sum"=>"import"
        )))
        ->pipe(new Sort(array(
            "import"=>"desc"
        )))
        ->pipe($this->dataStore('sales'));
    }
}