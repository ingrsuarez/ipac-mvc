





    <div class="board3">
        <div class="titulo_grafica">
            <h3 class="t_grafica">Informe desempeño <?php echo (date ( "Y" ));?></h3>
        </div>
        <div class="sub_board">
            <div class="sep_board"></div>
            <div class="cont_board">
                <div class="graf_board">
                    <div class="barra">

                        <div class="sub_barra4 b<?php echo $datos[0][1]?>">

                            <div class="tag_g"><?php echo $datos[0][0]?></div>
                            <div class="tag_leyenda"><a href="<?php echo base_url(); ?>index.php/registros/listado_reportes/"   >Incidentes</a></div>
                        </div>
                    </div>
                    <div class="barra">
                        <div class="sub_barra3 b<?php echo $datos[1][1]?>">
                            <div class="tag_g"><?php echo $datos[1][0]?></div>
                            <div class="tag_leyenda"><a href="<?php echo base_url(); ?>index.php/registros/mis_noConformidades/">No Conformidades</a></div>
                        </div>
                    </div>
                    <div class="barra">
                        <div class="sub_barra2 b<?php echo $datos[2][1]?>">
                            <div class="tag_g"><?php echo $datos[2][0]?></div>
                            <div class="tag_leyenda"><a href="<?php echo base_url(); ?>index.php/registros/listado_meritos/">Bono Productivo</a></div>
                        </div>
                    </div>
                    
                </div>
                <div class="tag_board">
                    <div class="sub_tag_board">
                        <div>100</div>
                        <div>90</div>
                        <div>80</div>
                        <div>70</div>
                        <div>60</div>
                        <div>50</div>
                        <div>40</div>
                        <div>30</div>
                        <div>20</div>
                        <div>10</div>
                    </div>
                </div>
           </div> 
            <div class="sep_board"></div>
       </div>    
    </div>

</body>