
		<div class="container">
			<div class="container_title">
				<h2>Cálculos</h2>
			</div>
			<div class="flow_column">
				<!-- Nav tabs -->
				<ul class="menu__item" role="tablist">
					<li class="tab__item">
					  <a class="tab-link active" data-toggle="tab" id="hemoglobina_link" href="#hemoglobina">Hemoglobina</a>
					</li>
					<li class="tab__item">
					  <a class="tab-link" data-toggle="tab" id="clearence_link" href="#clearence">Clearence</a>
					</li>
					<li class="tab__item">
					  <a class="tab-link" data-toggle="tab" id="homa_link" href="#homa">Homa</a>
					</li>
					<li class="tab__item">
					  <a class="tab-link" data-toggle="tab" id = "proteinograma_link" href="#proteinograma">Proteinograma</a>
					</li>
					<li class="tab__item">
					  <a class="tab-link" data-toggle="tab" id="calcioionico_link" href="#calcioIonico">Calcio Iónico</a>
					</li>
				</ul>
			</div>

			<!-- Tab panes -->
			
				<div id="hemoglobina" class="tab-content active"><br>
					<div class="calculos">	
						
						<p>Glicosilada = ((HbA1c/Hb)*91.5)+2.15</p>
						<label for="glic">HBA1C g/dl</label><input type="number" id="glic" step="0.001" min="0" name="glic" value="1" max="50">
						<label for="hb">Hemoglobina</label><input type="number" id="hb" step="0.1" min="0" name="hb" value="10" max="100"><br><br>
						<label for="pglic">Glicosilada:</label>
						<input type="text" id="hba1c" name="pglic" value="0" readonly><br><br>
						<!--IFCC-->	
						
						<p>IFCC = (%HbA1C-2.15)/0.095</p>
						<label for="ifcc">IFCC</label>
						<input type="text" name="ifcc " id="ifcc" value="0" readonly><br>
						<input type="submit" id="Calcular" value="Calcular" class="btn btn-verify">
						
					</div>
					<script type="text/javascript">
						$("#Calcular").click(function(){
							var glic=0;
							var hb=0;
							
							glic = parseFloat($("#glic").val());
							hb = parseFloat($("#hb").val());
							hb1ac = (((glic/hb)*91.5)+2.15).toFixed(2);
							ifcc = ((hb1ac-2.15)/0.095).toFixed(2);
							$("#hba1c").val(hb1ac);
							$("#ifcc").val(ifcc);						
						})
					</script>	
				</div>
				
				<div id="clearence" class="tab-content fade"><br>	
						<div class="calculos">
							<p></p>
							<label for="creatininaS">Creatinina en suero:</label><input type="number" id="creatiS" step="0.01" min="0" name="creatininaS" value="1" max="50">
							<label for="creatininaO">Creatinina en orina:</label><input type="number" id="creatiO" step="0.1" min="0" name="creatininaO" value="1" max="50"><br><br>
							<label for="diuresis">Diuresis:</label><input type="number" id="diuresis" step="1" min="0" name="diuresis" value="1" max="5000"> 
							<label for="peso">Peso:</label><input type="number" id="peso" step="1" min="1" name="peso" value="50" max="500">
							<label for="altura">Altura:</label><input type="number" id="altura" step="0.01" min="0.4" name="altura" value="1" max="500">
							<label for="edad">Edad:</label><input type="number" id="edad" step="0.01" min="0.4" name="edad" value="1" max="500"><br><br>

							<label for="volmin">Vol/min:</label><input type="number" id="volmin" step="0.01" min="0" name="volmin" value="1" max="500" readonly><br><br>
							<label for="supcorp">Superficie corporal:</label><input type="number" id="supcorp" step="0.01" min="0" name="supcorp" value="1" max="100" readonly>
							<label for="supcorpcorr">CL corregido por Sup.:</label><input type="number" id="supcorpcorr" step="0.01" min="0" name="supcorpcorr" value="1" max="100" readonly><br><br>
							<label for="hombre">Hombre:</label><input type="number" id="hombre" step="0.01" min="0" name="hombre" value="1" max="100" readonly>
							<label for="mujer">Mujer:</label><input type="number" id="mujer" step="0.01" min="0" name="mujer" value="1" max="100" readonly>	<br><br>
							<input type="submit" id="CalcularC" value="Calcular" class="btn btn-success">	
						</div>
						<div class="tablaw">
							<table>
								<tr>
									<th>INDICE WALSER</th>
									<th></th>
								</tr>
								<tr>
									<td>0.9 - 1.1 </td>
									<td>Orina bien recolectada</td>
								</tr>
								<tr>
									<td>0.75-0.9</td>
									<td>Corregir DC X Indice</td>
								</tr>
								<tr>
									<td>1.10-1.20</td>
									<td>Corregir DC X Indice</td>
								</tr>
								<tr>
									<td> &gt 1.25 o &lt 0.75</td>
									<td>Orina mal recolectada</td>
								</tr>
							</table>
						</div>
					
					<script type="text/javascript">

						$("#creatiS").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularC").click();
				            }
				        });	
						$("#creatiO").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularC").click();
				            }
				        });
						$("#diuresis").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularC").click();
				            }
				        });
						$("#peso").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularC").click();
				            }
				        });
						$("#altura").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularC").click();
				            }
				        });
						$("#edad").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularC").click();
				            }
				        });


						$("#CalcularC").click(function(){
							var calculo=0;
							var creatiS=0;
							var creatiO=0;
							var diuresis=0;
							var peso=0;
							var altura=0;
							var edad=0;
							var volmin=0;
							var supcorp=0;
							var supcorpcorr=0;
							var hombre=0;
							var mujer=0;
							var crum=0;
							var iwh=0;
							var iwm=0;
							creatiS = parseFloat($("#creatiS").val());
							creatiO = parseFloat($("#creatiO").val());
							diuresis = parseFloat($("#diuresis").val());
							peso = parseFloat($("#peso").val());
							altura = parseFloat($("#altura").val());
							edad = parseFloat($("#edad").val());
							volmin	= 	((diuresis/24)/60).toFixed(2);	
							supcorp = (Math.sqrt((peso*altura)/3600)).toFixed(3);		
							supcorpcorr = ((((creatiO/creatiS)*volmin)*1.73)/supcorp).toFixed(2);
							crum = (creatiO*10)*(diuresis/1000);
							hombre = ((28.2-(0.17*edad))*peso).toFixed(2);
							mujer = ((21.9-(0.115*edad))*peso).toFixed(2);
							iwh = (crum/hombre).toFixed(2);
							iwm = (crum/mujer).toFixed(2);
							$("#volmin").val(volmin);
							$("#supcorp").val(supcorp);
							$("#supcorpcorr").val(supcorpcorr);
							$("#hombre").val(iwh);
							$("#mujer").val(iwm);
							
						})
					</script>	
				</div>
				<div id="homa" class="tab-content fade"><br>
					<div class="tablah">
						<h4>Homa</h4>
						<p style="font-size: 90%;">ÍNDICE DE RESISTENCIA A LA INSULINA (HOMA-IR): </p>
						<label for="insulina">Insulina:</label><input type="number" id="insulina" step="0.01" min="0.4" name="insulina" value="1" max="500" style="float: right;"><br>
						<label for="glucosa">Glucosa mg/dl:</label><input type="number" id="glucosa" step="0.01" min="0.4" name="glucosa" value="1" max="500" style="float: right;"><br>
						
						<label for="ih">Índice HOMA</label><input type="number" id="ih" step="0.01" min="0.4" name="ih" value="1" max="500" style="float: right;"><br>
						<input type="submit" id="CalcularIh" value="Calcular" class="btn btn-success">

					</div>
					<div class="tablai" >
							<table>
								<tr>
									<th colspan="2" style="width: 100%; border: 1px solid #111111;"><h4>INDICE HOMA </h4></th>
									<th></th>
								</tr>
								<tr>
									<th style="width: 50%; border: 1px solid #111111;">Valor </th>
									<th style="width: 50%; border: 1px solid #111111;">Interpretación</th>
								</tr>
								<tr>
									<td style="width: 50%; border: 1px solid #111111;">Valores inferiores 1.96</td>
									<td style="width: 50%; border: 1px solid #111111;">Sin resistencia a la insulina</td>
								</tr>
								<tr>
									<td style="width: 50%; border: 1px solid #111111;">Valores de 1.96 a 3</td>
									<td style="width: 50%; border: 1px solid #111111;">Sospecha de resistencia a la insulina y requiere más estudios</td>
								</tr>
								<tr>
									<td style="width: 50%; border: 1px solid #111111;"> Valores superiores a 3</td>
									<td style="width: 50%; border: 1px solid #111111;">Resistencia a la insulina</td>
								</tr>
							</table>
					</div>
					<script type="text/javascript">

						$("#insulina").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularIh").click();
				            }
				        });
				        $("#glucosa").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularIh").click();
				            }
				        });

						$("#CalcularIh").click(function(){
							var glucosa =0;
							var insulina=0;
							var homa=0;
							glucosa = parseFloat($("#glucosa").val());
							insulina = parseFloat($("#insulina").val());
							homa = (((glucosa*0.0555)*insulina)/22.5).toFixed(2);
							$("#ih").val(homa).toFixed(2);
						});
					</script>	
				</div>
				<div id="proteinograma" class="tab-content fade"><br>	
					<div class="proteinograma">
						<h4>Proteinograma</h4>
						<tr>
							<td><label for="proteinas">Proteinas:</label>
							<input type="number" value="7" id="proteinas" name="proteinas" step="0.1" max="50"></td>
							<td><label for="albumina">Albumina:</label>
							<input type="number" value="4" id="albumina" name="albumina" step="0.1" max="50"></td>
						</tr>
						<tr>
							<td><label for="globulinas">Globulinas:</label>
							<input type="number" id="globulinas" name="globulinas" step="0.1" max="50" readonly></td>	
							<td><label for="relacionag">Relación Alb/Glob:</label>
							<input type="number" id="relacionag" name="relacionag" step="0.1" max="50" readonly></td>
						</tr>	
							
							<label for="alfa1">Alfa1:</label>
							<input type="number" id="alfa1" name="alfa1" step="0.1" style="padding: 2px;" value="0.29">
							<label for="alfa2">Alfa2:</label>
							<input type="number" id="alfa2" name="alfa2" step="0.1" style="padding: 2px;" value="0.75">
							<label for="beta">Beta:</label>
							<input type="number" id="beta" name="beta" step="0.1" style="padding: 2px;" value="0.9">	
							<br>
							<label for="gamma">Gamma:</label>
							<input type="number" id="gamma" name="gamma" step="0.1" style="padding: 2px;" readonly>
						<br>
						<input type="submit" class="btn btn-success" value="Calcular" id="calcularP">	


					</div>
					<script type="text/javascript">
						
						$("#alfa1").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#calcularP").click();
				            }
				        });

						$("#alfa2").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#calcularP").click();
				            }
				        });

				        $("#beta").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#calcularP").click();
				            }
				        });

						$("#proteinas").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#calcularP").click();
				            }
				        });    
						$("#albumina").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#calcularP").click();
				            }
				        });
						$("#calcularP").click(function(){
							var proteinas=0;
							var albumina=0;
							var alfa1 = 0;
							var alfa2 = 0;
							var beta = 0;
							albumina = parseFloat($("#albumina").val());
							proteinas = parseFloat($("#proteinas").val());
							var globulina = proteinas - albumina;
							var relacion = (albumina/globulina).toFixed(2);
							alfa1 = parseFloat($("#alfa1").val());
							alfa2 = parseFloat($("#alfa2").val());
							beta = parseFloat($("#beta").val());	
							var gamma = (globulina - (alfa1+alfa2+beta)).toFixed(2);
							$("#globulinas").val(globulina);
							$("#relacionag").val(relacion);
							$("#gamma").val(gamma);

						});	
					</script>
				</div>

				<div id="calcioIonico" class="tab-content fade"><br>
					<div class="tablah">
						<h4>Calcio Iónico</h4>
						<p style="font-size: 90%;">Es el calcio que no está adherido a las proteínas.</p>
						<label for="calcio">Calcio:</label><input type="number" id="calcio" step="0.01" min="0" name="calcio" value="1" max="50" style="float: right;"><br>
						<label for="proteinasC">Proteinas:</label><input type="number" id="proteinasC" step="0.01" min="0" name="proteinasC" value="1" max="50" style="float: right;"><br>
						
						<label for="calcioI">Calcio Iónico:</label><input type="number" id="calcioI" step="0.01" min="0" name="calcioI" value="1" max="100" style="float: right;"><br>
						<input type="submit" id="CalcularCI" value="Calcular" class="btn btn-success">

					</div>

					<script type="text/javascript">

						$("#calcio").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularCI").click();
				            }
				        });
				        $("#proteinasC").keypress(function(event) {
				            if (event.keyCode === 13) {
				                $("#CalcularCI").click();
				            }
				        });

						$("#CalcularCI").click(function(){
							var calcio =0;
							var proteinas=0;
							var calcioI=0;
							calcio = parseFloat($("#calcio").val());
							proteinas = parseFloat($("#proteinasC").val());
							calcioI = (((calcio*6)-(proteinas/3))/(proteinas+6)).toFixed(2);
							$("#calcioI").val(calcioI);
							
						});
					</script>

				</div>	
			
		</div>
		<script type = 'text/javascript' src = "<?php echo base_url();?>js/calculos.js"></script>
