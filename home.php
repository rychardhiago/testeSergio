<?phprequire_once("session.php");require_once("classes/class.produtos.php");$produtos = new produtos();$datafim = date('Y-m-d');$datainicio = date('Y-m-d') ;$sql   = "SELECT count(produtos.produtoid) contador ";$sql  .= "FROM produtos ";$sql  .= "WHERE excluido = 'N' ";$sql  .= "and data BETWEEN '".$datainicio." 00:00:00' and '".$datafim." 23:59:59'";$stmt = $produtos->runQuery($sql);$stmt->execute();$hoje = $stmt->fetch();$sql   = "SELECT count(categorias.categoriaid) contador ";$sql  .= "FROM categorias ";$sql  .= "WHERE excluido = 'N' ";$sql  .= "and data BETWEEN '".$datainicio." 00:00:00' and '".$datafim." 23:59:59'";$stmt = $produtos->runQuery($sql);$stmt->execute();$hojeCat = $stmt->fetch();$datafim = date('Y-m-31');$datainicio = date('Y-m-01');$sql   = "SELECT count(produtos.produtoid) contador ";$sql  .= "FROM produtos ";$sql  .= "WHERE excluido = 'N' ";$sql  .= "and data BETWEEN '".$datainicio." 00:00:00' and '".$datafim." 23:59:59'";$stmt = $produtos->runQuery($sql);$stmt->execute();$mes = $stmt->fetch();$sql   = "SELECT count(categorias.categoriaid) contador ";$sql  .= "FROM categorias ";$sql  .= "WHERE excluido = 'N' ";$sql  .= "and data BETWEEN '".$datainicio." 00:00:00' and '".$datafim." 23:59:59'";$stmt = $produtos->runQuery($sql);$stmt->execute();$mesCat = $stmt->fetch();?><!DOCTYPE HTML><html><head><title>Teste | Home </title><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="keywords" content="" /><script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script><link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' /><link href="css/style.css" rel='stylesheet' type='text/css' /><link href="css/font-awesome.css" rel="stylesheet"><link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'><link rel="stylesheet" href="css/icon-font.min.css" type='text/css' /><script src="js/jquery-2.1.1.min.js"></script><script src="js/amcharts.js"></script><script src="js/serial.js"></script><script src="js/light.js"></script><script src="js/radar.js"></script><link href="css/fabochart.css" rel='stylesheet' type='text/css' /><script src="js/css3clock.js"></script><script src="js/skycons.js"></script><script type="text/javascript" language="javascript" src="js/moment.min.js"></script></head> <body>   <div class="page-container">   <!--/content-inner-->	<div class="left-content">	   <div class="inner-content">			<div class="header-section">                <div class="top_menu">                    <div class="profile_details_left">                    </div>                    <div class="clearfix"></div>                </div>                <div class="clearfix"></div>			</div>					<!-- //header-ends -->						<div class="outter-wp">								<!--custom-widgets-->												<div class="custom-widgets">												   <div class="row-one">														<div class="col-md-3 widget">															<div class="stats-left ">																<h5>Produtos cadastrados</h5>																<h4>Hoje</h4>															</div>															<div class="stats-right">																<label><?php echo $hoje['contador']; ?></label>															</div>															<div class="clearfix"> </div>															</div>														<div class="col-md-3 widget states-mdl">															<div class="stats-left">																<h5>Categorias cadastrados</h5>																<h4>Hoje</h4>															</div>															<div class="stats-right">																<label class=""><?php echo $hojeCat['contador']; ?></label><br>															</div>															<div class="clearfix"> </div>															</div>														<div class="col-md-3 widget states-thrd">															<div class="stats-left">																<h5>Produtos cadastradas</h5>																<h4>Mês</h4>															</div>															<div class="stats-right">																<label><?php echo $mes['contador']; ?></label>															</div>															<div class="clearfix"> </div>															</div>														<div class="col-md-3 widget states-last">															<div class="stats-left">																<h5>Categorias cadastradas</h5>																<h4>Mês</h4>															</div>															<div class="stats-right">																<label class=""><?php echo $mesCat['contador']; ?></label>															</div>															<div class="clearfix"> </div>															</div>														<div class="clearfix"> </div>														</div>												</div>									</div>           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">               <div class="modal-dialog">                   <div class="modal-content">                       <div class="modal-header">                           <button type="button" class="close second" data-dismiss="modal" aria-hidden="true">×</button>                           <h2 class="modal-title">Rychard Hiago - Desenvolvedor Web</h2>                       </div>                       <div class="modal-body">                           (62) 9 8425-8554 <br>                           rychardhiago@gmail.com                       </div>                       <div class="modal-footer">                           <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>                       </div>                   </div><!-- /.modal-content -->               </div><!-- /.modal-dialog -->           </div>           <!--footer section start-->           <footer>               <p>&copy 2019 Teste | Desenvolvido por <a href="#" data-toggle="modal" data-target="#myModal">Rychard Hiago</a></p>           </footer>           <!--footer section end-->								</div>							</div>				<!--//content-inner-->			<!--/sidebar-menu-->				<div class="sidebar-menu">					<header class="logo">					<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="home.php"> <span id="logo"> <h1>Teste</h1></span>					<!--<img id="logo" src="" alt="Logo"/>--> 				  </a> 				</header>			<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>			<!--/down-->							<div class="down">	                                <a href="#"><h1><i class="glyphicon glyphicon-user"></i></h1></a>                                <a href="#"><span class=" name-caret"><?php echo $_SESSION['nome']; ?></span></a>                                <p>Profissional</p>                                <ul>                                    <li>                                        <a class="tooltips" href="logout.php"><span>Sair</span><i class="lnr lnr-power-switch"></i></a>                                    </li>                                </ul>                            </div>                           <div class="menu">                               <ul id="menu" >                               </ul>                           </div>                </div>       <div class="clearfix"></div>   </div><!--js --><link rel="stylesheet" href="css/vroom.css"><script type="text/javascript" src="js/vroom.js"></script><script type="text/javascript" src="js/TweenLite.min.js"></script><script type="text/javascript" src="js/CSSPlugin.min.js"></script><script src="js/jquery.nicescroll.js"></script><script src="js/scripts.js"></script><script src="js/funcoes.js"></script><!-- Bootstrap Core JavaScript -->   <script src="js/bootstrap.min.js"></script></body></html>