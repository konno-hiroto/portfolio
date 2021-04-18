<?php
ob_start();
?>
<?php include ("file/db_conn.php"); ?>
<?php
    if(isset($_POST["logout"])){
        session_unset();
        header("Location: Log.php");
    }
    if(isset($_POST["receipt"])){
        header("Location: Reciept.php");
    }
?>
<html>
    <head>
    <style>
            header.menu{
                position: fixed; left: 0; right: 0; top: 0; width: 100%; height: 60px;
                box-shadow: 0px 0px 5px 2px #999;
            }
            div.menu{
                position: absolute;
                top: 50%; left: 5px; transform: translate(0%, -50%);
            }
            div.logout{
                position: absolute;
                top: 50%; right: 5px; transform: translate(0%, -50%);
            }
            button.menu{
                font-size: 14px;
                font-weight: bold;
                width: 125px;
                padding: 8px;
                border-radius: 15px;
                border-color: #404040;
                margin: 0px 5px;
                color: #404040;
                background-color: white;
            }
            button.menu:hover{
                background-color: #404040;
                color: white;
                transition: 0.5s;
            }
            div.test{
                position: fixed; top: 300px; left: 100px;
            }
             .title {
                width:500px;
                font-size: 32px;
                text-align : center;
                color: #6cb4e4;
                text-align: center;
                padding: 0.25em;
                border-top: solid 2px #6cb4e4;
                border-bottom: solid 2px #6cb4e4;
                border: solid 3px #6091d3;/*線*/
                border-radius: 10px;/*角の丸み*/
                display: block;
                margin: 0 auto 0 auto;
            }
            .me {
                width:530px;
                text-align : center;
                color: #6cb4e4;
                text-align: center;
                display: block;
                margin: 0 auto 0 auto;
                overflow-y:scroll;
                height: 200px;
                display: block;
            }
            .money{
                text-align : center;           
            }
             .rog {
                position: relative;
                margin: 30px 30% 30px 30%;
                text-align: center; 
            }
            .rog:before,
            .rog:after {
               position: absolute;
               z-index: 0;
               bottom: -10px;
               display: block;
               content: '';
               border: 1.5em solid #d90606;
            }

            .rog:before {
               left: -30px;
               border-left-width: 15px;
               border-left-color: transparent;
            }

            .rog:after {
               right: -30px;
               border-right-width: 15px;
               border-right-color: transparent;
            }

            .rog p {
               font-size: 20px;
               position: relative;
               z-index: 1;
               display: block;
               padding: 1rem 2rem;
               color: #fff;
               background: #fa4141;
            }         
            rog p:before,
            rog p:after {
               position: absolute;
               bottom: -10px;
               display: block;
               width: 10px;
               height: 10px;
               content: '';
               border-style: solid;
               border-color: #b70505 transparent transparent transparent;
            }
            rog p:before {
               left: 0;
               border-width: 10px 0 0 10px;
            }
            rog p:after {
               right: 0;
               border-width: 10px 10px 0 0;
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <form method="post" action="">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <h3>担当者：<?php echo $_SESSION['logeduser']['UserName']; ?></h3>
                <ul class="navbar-nav mr-auto"></ul>
                <span class="navbar-text">
                    <input type="submit" class="btn btn-secondary btn-lg" value="戻る" name="receipt">
                    <input type="submit" class="btn btn-secondary btn-lg" value="ログアウト" name="logout">
                </span>
            </nav>
        </form>
        
             <br>
             <br>
             <br>
           <div class="title">売上表示画面(商品単位)</div>
              <div class="rog"><p>〇〇の売上表示画面(〇月)</p></div>
           <div class="me">
           <?php
            $ice=$_POST["icename"];
            $stmt = $db->query("select * from  orders where iceid1 = ".$ice);
            $stmt = $db->query("select * from orders as o ,earningses as e where o.iceid1 = ".$ice." and o.earningsid = e.earningsid");
        print "<table border='1'>";//テーブル作成
        print "<tr><th>個数</th><th>売上金額</th></tr>";
               $banira=0;
               $tyoko=0;
                while($result = $stmt->fetch()){
                    $banira += 1;
                    $tyoko += $result["price"];
                   print "<tr><th><input value=".$result['date']."></td></tr>";
                }
                
                print "<tr><th><input value=".$banira."></th><td><input value=".$tyoko."></td></tr>";
              
                echo "</table>";
                $db = null;
            ?>
        </div>
         <br>
    </body>
</html>