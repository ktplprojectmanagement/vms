<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
    $('#example1').DataTable();
} );
</script>
<style>
    #example1_wrapper
    {
        margin-top: 68px;
    }
    
    #example1_info
    {
        margin-left: 119px;
    }
    
    #example1_length
    {
        display:none;
    }
    .holder {
        position: relative;
    }
    .dropdown {
        position: absolute;
        border: 1px solid #CCC;
        /*display: none;*/
        z-index: 1;
        background: white;
        height: auto;
        max-height: 196px;
        overflow-y: scroll;
        width: 210px;
    }
    
    .dropdown_desc {
        position: relative;
        border: 1px solid #CCC;
        /*display: none;*/
        z-index: 1;
        background: white;
        height: auto;
        max-height: 196px;
        overflow-y: scroll;
        width: auto;
        max-width: 356px;
    }
    
    input:focus + .dropdown {
        display: block;
    }
</style>
<table cellspacing="0" border="1" id="example" class="table table-striped table-bordered" style="width: 75%;margin-left: 121px; margin-top: 47px;">
    <thead>
            <tr>
                <th>Search Product</th>
                <th>HSN Code</th>
                <th>Description</th>
                 <th>Other Description</th>
            </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="text" class="product_name"></td>
            <td>
                <div class="holder">
                    <input type="text" class="product_code" />
                </div>
                <div class="dropdown" style="display:none">
                </div>
            </td>
            <td id="prod_desc">
                <div class="dropdown_desc" style="display:none">
                </div>
            </td>
            <td id="prod_desc1">
                <div class="dropdown_desc1" style="display:none">
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div class="row">
		<div class="col-md-5" style="margin-left: 153px">
			<button id="hsn_save" class="btn btn-primary" style="float:right">Save Data</button>
		</div>
	</div>
<table cellspacing="0" border="1" id="example1" class="table table-striped table-bordered" style="width: 75%;margin-left: 121px;">
    <thead>
            <tr>
                <th>Sr.No</th>
                <th>Select HSN Code</th>
                <th>Description</th>
                <th>Other Description</th>
                <th>Delete</th>
            </tr>
    </thead>
     <?php
                                       
                                                    
                                                    $code_list_val = '';$code_list_val1 = '';
                                                    if(isset($edit_user_details1['0']['hsn_code']) && $edit_user_details1['0']['hsn_code'] !='')
                                                    {
                                                        $code_list_val = explode('%^%',$edit_user_details1['0']['hsn_code']);
                                                        $code_list_val1 = explode('%^%',$edit_user_details1['0']['other_comment']);
                                                    }
                                                        if(isset($code_list_val) && count($code_list_val)>0)
                                                        {
                                                            for($list=0;$list<count($code_list_val);$list++)
                                                            {
                                                            if(isset($code_list_val[$list]))
                                                            {
                                                                $this->db->select('*');
                                                                $this->db->from('HSN_list1');
                                                                $this->db->where('code = "'.$code_list_val[$list].'"');
                                                                $HSN_list = $this->db->get()->result_array();
                                                                $make_select_code = '';$make_select_comment = '';
                                                                if($HSN_list != '' && count($HSN_list)>0) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $list+1; ?></td>
                                                                    <td align="right"><?php echo $HSN_list['0']['code']; ?></td>
                                                                    <td align="left"><font face="Times New Roman" size=1><?php echo $HSN_list['0']['hsn_desc']; ?></font></td>
                                                                    <td><?php if(isset($code_list_val1[$list])) { echo $code_list_val1[$list];} ?></td>
                                                                    <td><button class="del_hsn btn btn-primary" id="del_<?php echo $HSN_list['0']['code']; ?>">Delete</button></td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <tr>
                                                                    <td><?php echo $list+1; ?></td>
                                                                    <td align="right"><?php echo $code_list_val[$list]; ?></td>
                                                                    <td align="left"><font face="Times New Roman" size=1></font></td>
                                                                    <td><?php if(isset($code_list_val1[$list])) { echo $code_list_val1[$list];} ?></td>
                                                                    <td><button class="del_hsn btn btn-primary" id="del_<?php echo  $code_list_val[$list]; ?>">Delete</button></td>
                                                                </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            }
                                                        }
                                                        
                                                   
                                                ?>
</table>
<div class="row">
		<div class="col-md-8" style="margin-left: 153px">
			<a href="<?php echo base_url(); ?>index.php/Vendordetails"><button type="button" class="btn btn-primary">Back</button></a>
		</div>
	</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="modal fade" id="modal-container-204273" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
               
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×
              </button>
              <h4 class="modal-title" id="myModalLabel">
                Alert
              </h4>
            </div>
            <div class="modal-body" id="err_show">
              ...
            </div>
            <div class="modal-footer">
               
              <button type="button" class="btn btn-default" data-dismiss="modal">
                Close
              </button> 
              
            </div>
          </div>
          
        </div>
        
      </div>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <input type="text"  id="vendor_id" name="vendor_id" style="display:none" value="<?php if(isset($edit_user_details) && count($edit_user_details)>0 && isset($edit_user_details['0']['Vendor_id'])) { echo $edit_user_details['0']['Vendor_id']; }?>"  disabled/>
<script>
    $(function(){
        $("body").on('click','.del_hsn',function(){
            var id= $(this).attr('id');
            var id1 = id.split('del_');
            var data = {
                code : id1,
                vendor_id : $("#vendor_id").val()
            };
            var base_url = window.location.origin;
             $.ajax({
            'type' : 'post',
            'datatype' : 'html',
            'data' : data,
              url : base_url+'/vms/index.php/HSN/deldata',
              success : function(data)
              {
                 // alert(data);
                $("#modal-container-204273").modal('show');
                $("#err_show").text("Selected HSN code successfully removed");
                location.reload();
              }
            });
        });
        $("body").on('keyup','.product_name',function(){
            $(".dropdown").css('display','block');
            var base_url = window.location.origin;
            var data = {
                prod_name : $(".product_name").val()
            }
            $.ajax({
            'type' : 'post',
            'datatype' : 'json',
            'data' : data,
              url : base_url+'/vms/index.php/HSN/getdata',
              success : function(data)
              {
                var detail = jQuery.parseJSON(data);
                $(".product_code").attr('value',detail[0]);
                $(".dropdown").html(detail[1]);
              }
            });
        });
        
        $("body").on('click','.hsn_val',function(){
            $(".dropdown_desc").css('display','block');
             $(".dropdown_desc1").css('display','block');
            var selected_value = []; // initialize empty array 
            $(".hsn_val:checked").each(function(){
                selected_value.push($(this).attr('id'));
            });
            var HSN_list = selected_value;
            var base_url = window.location.origin;
            var data = {
                HSN_list : HSN_list
            }
            $.ajax({
            'type' : 'post',
            'datatype' : 'json',
            'data' : data,
              url : base_url+'/vms/index.php/HSN/hsn_data',
              success : function(data)
              {
                  var detail = jQuery.parseJSON(data);
                 // alert(detail[1]);
                $(".dropdown_desc").html(detail[0]);
                $(".dropdown_desc1").html(detail[1]);
              }
            });
            //alert(HSN_list);
        });
        
        $("body").on('keyup','.product_code',function(){
            $(".dropdown").css('display','block');
             $(".dropdown_desc1").css('display','block');
            var base_url = window.location.origin;
            var data = {
                prod_code : $(".product_code").val()
            }
            $.ajax({
            'type' : 'post',
            'datatype' : 'json',
            'data' : data,
              url : base_url+'/vms/index.php/HSN/getdata_code',
              success : function(data)
              {
                  //alert(data);
                var detail = jQuery.parseJSON(data);
               // $(".product_code").attr('value',detail[0]);
                $(".dropdown").html(detail[0]);
                $(".dropdown_desc1").html(detail[1]);
              }
            });
        });
        
        $("body").on('click','#hsn_save',function(){
        var selected_value = []; // initialize empty array 
        var text_data = '';
        console.log(selected_value);
            $(".hsn_val:checked").each(function(){
                selected_value.push($(this).attr('id'));
            });
            if(selected_value.length==0 && $(".product_code").val() !='')
            {
                 selected_value.push($(".product_code").val());
            }
            for(var i=0;i<selected_value.length;i++)
            {
                var dt = '';
                if($("#other_"+i).val() != '')
                {
                    dt = $("#other_"+i).val();
                }
                else
                {
                    dt = 'NA';
                }
                if(text_data == '')
                {
                    text_data = dt;
                }
                else
                {
                    text_data = text_data+'%^%'+dt;
                }
                //alert(selected_value[i]);
            }
           //alert(text_data);
            var HSN_list = selected_value;
            var data = {
               code_list : selected_value,
              code_comment : text_data,
               vendor_id : $("#vendor_id").val()
            };
            //alert($("#vendor_id").val());
            var base_url = window.location.origin;
            $.ajax({
            'type' : 'post',
            'datatype' : 'html',
            'data' : data,
              url : base_url+'/vms/index.php/HSN/savedata',
              success : function(data)
              {
                //  alert(data);
               $("#modal-container-204273").modal('show');
                $("#err_show").text("Selected HSN code successfully saved");
location.reload();
              }
            });
            //alert(text_data);
        });
    });
</script>