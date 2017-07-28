<div class="main">
			<!-- NAVBAR -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-btn">
						<button type="button" class="btn-toggle-fullwidth"></button>
					</div>
					
					<div id="navbar-menu" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
                                <a href="<?php echo base_url(); ?>index.php/Adminlogin" class="dropdown-toggle" data-toggle="dropdown"><span>Logout</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                                <ul class="dropdown-menu">
                                    <!-- <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                    <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                                    <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
                                    <li><a href="<?php echo base_url(); ?>index.php/Adminlogin"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                                </ul>
                            </li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- END NAVBAR -->
			<!-- MAIN CONTENT -->
			<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
			<script type="text/javascript">
				$(function(){
					$('#select-all').click(function(event) {
				        var $that = $(this);
				        $(':checkbox').each(function() {
				            this.checked = $that.is(':checked');
				        });
				    });
				});
			</script>
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Vendor List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped" id="exapletable">
										<thead>
											
											<tr>
												<th>Vendor ID</th>
												<th>Name</th>
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody id="purch_based_vendor">
										<?php
											if (isset($vendor_details) && count($vendor_details)>0) {
												for ($i=0; $i < count($vendor_details); $i++) { 
													?>
														<tr>
															<td><?php echo $vendor_details[$i]['Vendor_id']; ?></td>
															<td><?php echo $vendor_details[$i]['Name']; ?></td>
															<td>
																<form method="post" target="_new" action="http://52.172.210.251/vms/index.php/Vendordata">
																	<input type="text" name="vendor_id" style="display: none" value="<?php echo $vendor_details[$i]['Vendor_id']; ?>">
																	<input type="submit" name="submit"  value="Check">
																</form>
															<!-- <a href="<?php echo base_url(); ?>index.php/Vendordetails"><span class="label label-success">Check</span></a> -->
															</td>
														</tr>
													<?php
												}
											}
										?>
										</tbody>
									</table>
								
								</div>
							</div>
							<div class="col-md-6">

							</div>
							<!-- END RECENT PURCHASES -->
						</div>
					
					</div>
					<div class="row" style="margin-top: 19px;">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel"  style="display:none">
								<div class="panel-heading">
									<h3 class="panel-title">Recent Purchases</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>select</th>
												<th>Purchaser_Name</th>
												<th>ID</th>
												<th>Name</th>
												<th>Type</th>
												<th>Action</th>
												<!-- <th>Status</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											if (isset($already_sent) && count($already_sent)>0) {
												for ($i=0; $i < count($already_sent); $i++) { 
													?>
														<tr>
															<td><input type="checkbox" value="<?php echo $already_sent[$i]['Vendor_id']; ?>" id="<?php echo $already_sent[$i]['Vendor_id']; ?>"></td>
															<td><?php echo $already_sent[$i]['Sub_Purchaser_Name']; ?></td>
															<td><?php echo $already_sent[$i]['Vendor_id']; ?></td>
															<td><?php echo $already_sent[$i]['Name']; ?></td>
															<td><?php echo $already_sent[$i]['vendor_type']; ?></td>
															<td>
																<form method="post" target="_new" action="<?php echo base_url(); ?>index.php/Vendordata">
																	<input type="text" name="vendor_id" style="display: none" value="<?php echo $already_sent[$i]['Vendor_id']; ?>">
																	<input type="submit" name="submit"  value="Check">
																</form>
															<!-- <a href="<?php echo base_url(); ?>index.php/Vendordetails"><span class="label label-success">Check</span></a> -->
															</td>
														</tr>
													<?php
												}
											}
										?>
										</tbody>
									</table>
								</div>								
							</div>
							<!-- END RECENT PURCHASES -->
						</div>
					</div>
			</div>
				
				</div>
			</div>
			<script type="text/javascript">
				$(function(){
					$("body").on('change','.select_purchaser',function(){
						var data = {
							'purch_id' : $(this).val()
						};
						//alert($(this).val());
						 var base_url = window.location.origin;
				            $.ajax({
					              type : 'post',
					              data : data,
					              url : base_url+'/vms/index.php/Vendorlist/get_vendor',
					              success : function(data)
					              {
					                  //alert(data);
					                  $("#purch_based_vendor").html(data);
					              }
				            });
					});
					$("#send_mail").click(function(){
						 var vendor_value = '';
				          $("input:checked").map(function () { 
				            if($(this).val() != 'on')
{
if (vendor_value == '') 
				            {
				              vendor_value = $(this).val();
				            }
				            else
				            {
				              vendor_value = vendor_value+'!'+$(this).val();
				            }
}
				            //alert($(this).val());
				            //type_vendor = 1;
				          });
				          //alert(vendor_value);
				          var data = {
				          	'vendor_value' : vendor_value
				          };
				          var base_url = window.location.origin;
				            $.ajax({
				              type : 'post',
				              data : data,
				              url : base_url+'/vms/index.php/Vendorlist/send_mails',
				              success : function(data)
				              {
				                  alert(data);
				                 window.setTimeout(function() {
    window.location.href = 'http://partners.vvfltd.com/vms/index.php/Vendorlist_user';
}, 1000);
				              }
				            });
					});

$("#send_mail_tech").click(function(){
						 var vendor_value = '';
				          $("input:checked").map(function () { 
if($(this).val() != 'on')
{
				            if (vendor_value == '') 
				            {
				              vendor_value = $(this).val();
				            }
				            else
				            {
				              vendor_value = vendor_value+'!'+$(this).val();
				            }
}
				            //alert($(this).val());
				            //type_vendor = 1;
				          });
				          //alert(vendor_value);
				          var data = {
				          	'vendor_value' : vendor_value
				          };
				          var base_url = window.location.origin;
				            $.ajax({
				              type : 'post',
				              data : data,
				              url : base_url+'/vms/index.php/Vendorlist/tech_send_mails',
				              success : function(data)
				              {
				                  alert("Mail Sent Successfully");
				              }
				            });
					});
				});
			</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<script type='text/javascript' src='https://code.jquery.com/jquery-1.12.4.js'></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js'></script>
<script>
$(document).ready(function() {
    $('#exapletable').DataTable();
} );
</script>
			<!-- END MAIN CONTENT