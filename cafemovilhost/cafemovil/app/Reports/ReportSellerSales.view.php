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
                        <h4>Este reporte muestra tus ventas en orden descendente agrupadas por producto</h4>
                    </div>
                    <hr/>

                    <?php
                        BarChart::create(array(
                            "dataStore"=>$this->dataStore('sales'),
                            "width"=>"100%",
                            "height"=>"500px",
                            "columns"=>array(
                                "product_name"=>array(
                                    "label"=>"Producto"
                                ),
                                "import"=>array(
                                    "type"=>"number",
                                    "label"=>"Monto",
                                    "prefix"=>"$",
                                )
                            ),
                            "options"=>array(
                                "title"=>"Tus ventas"
                            )
                        ));
                    ?>

                    <?php
                    Table::create(array(
                        "dataStore"=>$this->dataStore('sales'),
                            "showFooter"=>"bottom",
                            "columns"=>array(
                                "product_name"=>array(
                                    "label"=>"Producto"
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