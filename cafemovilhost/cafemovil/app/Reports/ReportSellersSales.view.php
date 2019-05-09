<!-- MyReport.view.php -->
<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\BarChart;
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            

                <div class="card-body">
                    <div class="text-center">
                        <h1>Reporte de ventas</h1>
                        <h4>Este reporte muestra ventas de vendedores en orden descendente</h4>
                    </div>
                    <hr/>

                    <?php
                        BarChart::create(array(
                            "dataStore"=>$this->dataStore('sales'),
                            "width"=>"100%",
                            "height"=>"500px",
                            "columns"=>array(
                                "email"=>array(
                                    "label"=>"Vendedor"
                                ),
                                "import"=>array(
                                    "type"=>"number",
                                    "label"=>"Monto",
                                    "prefix"=>"$",
                                )
                            ),
                            "options"=>array(
                                "title"=>"Ventas por vendedor"
                            )
                        ));
                    ?>

                    <?php
                    Table::create(array(
                        "dataStore"=>$this->dataStore('sales'),
                            "showFooter"=>"bottom",
                            "columns"=>array(
                                "email"=>array(
                                    "label"=>"Vendedor"
                                ),
                                "import"=>array(
                                    "type"=>"number",
                                    "label"=>"Monto",
                                    "prefix"=>"$",
                                    "footer"=>"sum",
                                    "footerText"=>"TOTAL: @value"
                                )
                            ),
                        "cssClass"=>array(
                            "table"=>"table table-hover table-bordered"
                        )
                    ));
                    ?>
                </div>
        </div>
    </div>
</div>