<?php 
session_start();

/* Query */    
            if(isset($_POST['cpf'], $_POST['date'])){
                try
                {
                    $pdo = new PDO("sqlsrv:server=JIVE-NTK78;Database=Consumer_DB","sa","jive1234");
                    $cpf = $_POST['cpf'];
                    $date = $_POST['date'];
                    $stmt = $pdo->prepare("SELECT * FROM TAB_DEV WHERE CPF_DEV=(:cpf) AND NASC_DEV2=(:data)");
                    $stmt->execute(array(
                    ':cpf' => $cpf,
                    ':data' => $date
                ));
                    $r = $stmt->fetch(PDO::FETCH_NUM);
                }
                catch(PDOException $error)
                {
                    var_dump ($error);
                    die("ERRO NO BANCO DE DADOS, TENTE MAIS TARDE");
                    exit();
                }
                
                if($r[2] != $cpf ){
                    header("Location: consulta.php");
                    $_SESSION['error'] = "error";
                    exit();
                }
                elseif($r[2] == $cpf && $r[4] == "SIM"){    
                    header("Location: cartas.php");
                    $_SESSION['nome'] = $r[1];
                    $_SESSION['cpf'] = $r[2];
                    $_SESSION['cartas'] = $r[4];
                    exit();
                }
                elseif($r[2] == $cpf && $r[4] == "NAO"){
                    header("Location: ncartas.php");
                    $_SESSION['nome'] = $r[1];
                    $_SESSION['cartas'] = $r[4];
                    exit();
                }
                elseif($r[2] == $cpf && $r[4] == "LEG"){
                    header("Location: contato.php");
                    $_SESSION['nome'] = $r[1];
                    $_SESSION['cartas'] = $r[4];
                    exit();
                }
   
}               if(isset($_POST['download']) and $_SERVER['REQUEST_METHOD'] == "POST"){
                       //CONECTA AO FTP E BAIXA
                        include('php_class.php');
                
                        $ftpObj = new FTPClient();
                        
                        $ftpObj -> ftpconnect();
                       
                        if ($ftpObj ->  ftpconnect())
                            {
                            echo "AQUI VAI O DIRETORIO FTP";
                            $arquivo = "carta_anuencia.docx";      # The location on the server
                            $location = "/Downloads/";            # Local dir to save to
 
                            // *** Download file
                            //$ftpObj->downloadFile($arquivo, $location);    
                            
                        } else {
                            echo "ERRO";
                            exit();
                        }
}        

?>

