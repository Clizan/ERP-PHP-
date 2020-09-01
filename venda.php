<?php
    include 'conexao.php';
?>

<html>
    <head>
        <title></title>

    </head>
    <body>
        <form name = "cadastrar" method = "post" action = "">  

            <input type = "text" name = "cliente" value = "1" style = "visibility: hidden"/>                  
            
            <input type = "hidden" name="data" value="<?php echo date('d/m/y')?>"><!--Campo data php para salvar no banco -->        


            <label>Código de Barras </label>
            <input type = "text" name = "cod" />
            
            <label>Quantidade </label>
            <input type = "text" name = "qtd" />

            <label>Sub. Total </label>
            <input type = "text" name = "valor" />

            <input type = "text" name = "total" style = "visibility: hidden"/>

            <?php    
                if(isset($_POST['cod'])){

                    //Variaveis PHP
                    $cod        = $_POST['cod'];
                    $quantidade = $_POST['qtd'];
                    $valor      = $_POST['valor'];

                    $total = $quantidade * $valor;

                    if(!empty($cod)){

                        $sql = mysqli_query($conexao, "INSERT INTO teste (codigo, quantidade, valor, total) VALUES ('$cod', '$quantidade', '$valor', '$total')");
                    
                    }else{
                        echo "As variáveis não estão preenchidas!";
                    }    
                }
            ?>

            <button type="submit" name = "btn_adduser" class="btn btn-dark">Adicionar</button>      

            <table class = "table table-dark table-hover">
                <thead>
                    <tr>
                        <td style = "font-family: verdana; font-size: 12px; font-weight: bold;">Código</td>
                        <td style = "font-family: verdana; font-size: 12px; font-weight: bold;">IdCliente</td>
                        <td style = "font-family: verdana; font-size: 12px; font-weight: bold;">Quantidade</td>
                        <td style = "font-family: verdana; font-size: 12px; font-weight: bold;">Sub Total</td>
                        <td style = "font-family: verdana; font-size: 12px; font-weight: bold;">Total</td>
                    </tr>
                </thead>

                <?php
                    $sql = mysqli_query($conexao, "SELECT codigo, idCliente, quantidade, valor, total FROM teste WHERE idCliente = ' '");
                        
                    while ($linha = mysqli_fetch_array($sql)){

                ?>        

                <tbody>				                       
                    <tr>
                        <td style = "font-family: verdana; font-size: 12px;"><?php echo $linha["codigo"]?></td>
                        <td style = "font-family: verdana; font-size: 12px;"><?php echo $linha["idCliente"]?></td>
                        <td style = "font-family: verdana; font-size: 12px;"><?php echo $linha["quantidade"]?></td>
                        <td style = "font-family: verdana; font-size: 12px;"><?php echo $linha["valor"]?></td>
                        <td style = "font-family: verdana; font-size: 12px;"><?php echo $linha["total"]?></td>    
                    </tr>
                </tbody>            
                
                
                <?php
                    }
                ?>

            </table>           
            
            <input type="radio" name= "opcao" value = "credito">Crédito</option>
			<input type="radio" name= "opcao" value = "debito"   style = "margin-left: 20px;">Débito</option>
            <input type="radio" name= "opcao" value = "dinheiro" style = "margin-left: 20px;">Dinheiro</option>
            <button type="submit" name = "btn_adduser" class="btn btn-dark">Finalizar Compra</button>
            
            <?php
					
				if(isset($_POST['opcao'])){  
                    
                    $data  = $_POST['data'];
                    $opcao = $_POST['opcao'];

					if(!empty($opcao)){
						
						$update = mysqli_query($conexao, "UPDATE teste SET data = '$data', opcao = '$opcao', IdCliente = '1' WHERE IdCliente = ''");								
					}
				}						
			?>            


        </form>    

    </body>
</html> 
