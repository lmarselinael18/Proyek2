<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('aceadmin/headeradmin'); ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Ubah status Magang</li>
						</ul>

						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								Ubah Status Magang
								
							</h1>
						</div><!-- /.page-header -->

						<div class="container" id="notif">
							<?php if ($this->session->flashdata('msg')) : ?>
								<div class="alert alert-success">
								<?php echo $this->session->flashdata('msg') ?>	
								</div>
							<?php endif; ?>
							<?php if ($this->session->flashdata('msg1')) : ?>
								<div class="alert alert-danger">
								<?php echo $this->session->flashdata('msg1') ?>	
								</div>
							<?php endif; ?>
						</div>

						<div id="inputModal" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-title" align="center">
										<h2>INPUT DATA USER</h2>
									</div>
									<form action="<?php echo site_url(); ?>/admin2/newadmin" enctype="multipart/form-data" method="post">
									<div class="modal-body">
										<input type="text" class="form-control ins" placeholder="Username" id="username" name="username"><br>
										<input type="password" class="form-control ins" placeholder="Password" id="password" name="password"><br>
										<input type="text" class="form-control ins" placeholder="id divisi" id="id_divisi" name="id_divisi"><br>
										<input type="text" class="form-control ins" placeholder="Nama Admin" id="nama_admin" name="nama_admin"><br>
										<br>
										<input type="hidden" value="submit" name="update">
									</div>

									<div class="modal-footer">
										<button class="width-15 pull-left btn btn-warning " type="button">
											<a href="<?php echo site_url(); ?>/admin2/index" style="color: white;">cancel</a>
										</button>
										<input name="update" id="submitFormups" type="submit" value="save" class="btn btn-success">
									</div>
									</form>
								</div>
							</div>
						</div>

						<?php foreach ($user as $key) { ?>
						<div id="ModalEdit<?php echo $key['id_pkl'];?>" role="dialog" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-title" align="center">
										<h2>Update Status Magang</h2> 
									</div>
									<form action="<?php echo site_url(); ?>/admin/updatestatuspkl/<?php echo $key['id_pkl']; ?>/<?php echo $key['tgl_mulai']; ?>/<?php echo $key['tgl_selesai']; ?>/<?php echo $key['jml_pkl']; ?>/<?php echo $key['id_divisi']; ?>" enctype="multipart/form-data" method="post">
									<div class="modal-body">
										<select name="up_status" class="form-control">
											<option value="calon">Pendaftar</option>
											<option value="peserta">Peserta</option>
											<option value="selesai">Selesai</option>
											<option value="Tolak">DiTolak</option>
										</select>
										<br>
										<input type="hidden" name="up_UID" value="<?php echo $key['UID']; ?>" class="form-control">
										<br>
										<input type="hidden" value="submit" name="update">
									</div>

									<div class="modal-footer">
										<button class="width-15 pull-left btn btn-warning ">
											<a href="<?php echo site_url(); ?>/admin/ubahstatuspkl" style="color: white;">cancel</a>
										</button>
										<input name="update" id="submitFormups" type="submit" value="update" class="btn btn-success">
									</div>
									</form>
								</div>
							</div>
						</div>
						<?php }?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
									
									</div><!-- /.span -->
								</div><!-- /.row -->

						
								<div class="row">
									<div class="col-xs-12">
									<!-- 	<h3 class="header smaller lighter blue">jQuery dataTables</h3> --> 
											<div class="pull-right tableTools-container"></div>
										</div>
										<div>
											<table id="simple-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Nama Divisi</th>
														<th>Nama Ketua Magang</th>
														<th>Jumlah Magang </th>						
														<th>Surat Pengantar</th>
														<th>Tanggal Mulai</th>
														<th>Tanggal Selesai</th>
														<th>Status</th>
														<th>Aksi</th>
													</tr>
												</thead>

												<tbody>
												<?php foreach ($user as $key) { ?>
													<tr>
														<td><?php echo $key['nama_divisi']?></td>
														<td><?php echo $key['nama_user']?></td>
														<td><?php echo $key['jml_pkl']?></td>
														<td><?php echo $key['srt_pengantar']?></td>
														<td>
															<?php echo date('d-m-Y', strtotime($key['tgl_mulai'])); ?>
														</td>
														<td>
															<?php echo date('d-m-Y', strtotime($key['tgl_selesai'])); ?>
														</td>
														<td><?php echo $key['status']?></td>
														<td>
														<a id="edit" class="green" data-toggle="modal" href="#ModalEdit<?php echo $key['id_pkl'];?>">
															<i class="ace-icon fa fa-pencil bigger-130"></i>
														</a>				
														
															<!-- <div class="hidden-sm hidden-xs action-buttons">										
																<a id="edit" class="green" href="<?php echo site_url(); echo "/admin2/editadmin/"; echo $key['UAID'];?>" method="post">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a id="delete" class="red" href="<?php echo site_url(); echo "/admin2/deleteadmin/"; echo $key['UAID'];?>" method="post"> 
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div> -->

															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<form action="<?php echo site_url(); echo "/admin2/editadmin/"; echo $key['UAID'];?>" method=post>
																		<li >
																			<!-- <a type="submit" class="tooltip-success" data-rel="tooltip" title="Edit"> -->
																			<input class="ace-icon fa fa-pencil-square-o bigger-120" type="submit" value="Update">
																				<!-- <span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span> -->
																			<!-- </a> -->
																		</li>
																		</form>

																		<li>
																			<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
																			</a>
																		</li>
																	</ul>
																	</div>
																</div>
														</td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
	
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">BIRUDEUN</span>
							Website &copy; 2020
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url(); ?>assets/assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/js/buttons.colVis.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/js/dataTables.select.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			// $(document).ready(function(){
			// $('#addnew').on('click', function(){
			// 	$('#inputModal').modal('show');
			// });
			// // displayData(0,60);
			// $('#edit').on('click', function(){
			// 	$('#inputModal2').modal('show');
			// });

			// displayData(0,60);
			// });
			$('#notif').slideDown('slow').delay(3000).slideUp('slow');

			$(document).ready(function(){
        	$('#simple-table').DataTable();
    		});

			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				// $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
				// 	var th_checked = this.checked;//checkbox inside "TH" table header
					
				// 	$(this).closest('table').find('tbody > tr').each(function(){
				// 		var row = this;
				// 		if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
				// 		else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
				// 	});
				// });
				
				// //select/deselect a row when the checkbox is checked/unchecked
				// $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
				// 	var $row = $(this).closest('tr');
				// 	if($row.is('.detail-row ')) return;
				// 	if(this.checked) $row.addClass(active_class);
				// 	else $row.removeClass(active_class);
				// });
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
		</script>
	</body>
</html>
