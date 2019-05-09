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
                        <h4>Este reporte muestra el top 10 de los productos más vendidos en tu escuela</h4>
                    </div>
                    <hr/>

                    <?php
                        BarChart::create(array(
                            "dataStore"=>$this->dataStore('products'),
                            "width"=>"100%",
                            "height"=>"500px",
                            "columns"=>array(
                                "name"=>array(
                                    "label"=>"Producto"
                                ),
                                "detail"=>array(
                                    "type"=>"number",
                                    "label"=>"Cantidad"
                                )
                            ),
                            "options"=>array(
                                "title"=>"Cantidad de productos vendidos"
                            )
                        ));
                    ?>
                    <?php
                    Table::create(array(
                        "dataStore"=>$this->dataStore('products'),
                            "columns"=>array(
                                "id_at_store"=>array(
                                    "label"=>"ID Producto"
                                ),
                                "name"=>array(
                                    "label"=>"Producto"
                                ),
                                "detail"=>array(
                                    "type"=>"number",
                                    "label"=>"Cantidad de ventas"
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