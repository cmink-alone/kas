<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <title>USER DASHBOARD</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    <?=$bootstrap;?>
	<?=$css;?>
		
	<!--js -->
		<?=$js;?>
		
		<!--end js-->	
 </head>
      <body class="skin-black">
        <!--header in_header.php-->
		<?=$in_header;?>	
        <!--header--> 
		
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<!-- menu_kiri in_menu_kiri.php-->
			<?=$in_menu_kiri;?>
			<!-- end_menu_kiri-->
				
			
		    <aside class="right-side in_konten">
				<!--konten -->
				
				<!-- end kontoen-->
				   
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <div class="footer-main">Powered Aang Firmansyah</div> 
		
<?=$js_manual;?>
</body>
</html>