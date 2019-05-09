<!-- MyReport.view.php -->
<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\PieChart;
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            

                <div class="card-body">
                    <div class="text-center">
                        <h1>Reporte de servicio</h1>
                        <h4>Este reporte muestra tu estado de las ordenes [servicio].</h4>
                    </div>
                    <hr/>

                    <?php
                        PieChart::create(array(
                            "title"=>"Estado de las Ordenes",
                            "dataSource"=>$this->dataStore("orders"),
                            "columns"=>array(
                                "status"=>array(
                                    "label"=>"Estado",
                                    "type"=>"string",
                                ),
                                "quantity")
                        ))
                    ?>

                    <?php
                    Table::create(array(
                        "dataStore"=>$this->dataStore('orders'),
                            "showFooter"=>"bottom",
                            "columns"=>array(
                                "status"=>array(
                                    "type"=>"number",
                                    "label"=>"Estado de la orden",
                                ),
                                "quantity"=>array(
                                    "type"=>"number",
                                    "label"=>"Cantidad de ordenes",
                                    "footer"=>"sum",
                                    "footerText"=>"TOTAL: @value"
                                )
                            ),
                        "cssClass"=>array(
                            "table"=>"table table-hover table-bordered"
                        )
                    ));
                    ?>
                    <p>Donde Estado de la orden: 0 es No entregado. 1 es Entregado parcialmente. 2 Totalmente entregdo.</p>
                </div>
        </div>
    </div>
</div>