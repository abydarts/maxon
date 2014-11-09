<div><h4>PROSES PENGELUARAN BARANG LAINNYA</H4>
<div class="thumbnail">
	<?
	echo link_button('Add','','add','true',base_url().'index.php/delivery/add');		
	echo link_button('Save', 'save()','save');		
	echo link_button('Print', 'print_delivery()','print');		
	echo link_button('Delete','','add','true',base_url().'index.php/delivery/delete/'.$shipment_id);		
	echo link_button('Search','','search','true',base_url().'index.php/delivery');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/delivery/view/'.$shipment_id);		
	echo link_button('Help', 'load_help()','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
 	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/delivery");
		}
	</script>
	
</div>
<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table>
	<tr>
		<td>Nomor Bukti</td><td>
		<?php echo form_input('shipment_id',$shipment_id,"id=shipment_id"); ?>
                </td>
	</tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('date_received',$date_received,'id=date_received 
            class="easyui-datetimebox" required ');?>
            </td>
       </tr>
	<tr>
		<td>Gudang</td><td><?php 
                echo form_dropdown('warehouse_code',
                    $warehouse_list,$warehouse_code,'id=warehouse_code');
                
                ?></td>
	</tr>
       <tr>
            <td>Pengirim</td><td><?php echo form_input('supplier_number',$supplier_number,'id=supplier_number');?></td>
       </tr>
       <tr>
            <td>Keterangan</td><td><?php echo form_input('comments',$comments,'id=comments style="width:400px"');?></td>
       </tr>
       <tr><td></td><td></td></tr>
       <tr>
           <td colspan="4"></td>
       </tr>
	 <tr><td> 
	 </td><td>&nbsp;</td></tr>
   </table>
   <div class='thumbnail'>
    <!-- LINEITEMS -->	
	<h5>ITEMS DETAIL</H5>
	<div id='dgItem'><?=load_view('inventory/select_item_no_price.php')?></div>
   </div>
</form>

<div id='divItem' class='thumbnail' style='display:<?=$mode=="add"?"":""?>'>
	<table id="dg" class="easyui-datagrid"  
		style="width:600px;min-height:800px"
		data-options="
			iconCls: 'icon-edit',
			singleSelect: true,
			toolbar: '#tb',
			url: url_load_item
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Kode Barang</th>
				<th data-options="field:'description',width:150">Nama Barang</th>
				<th data-options="field:'quantity_received',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
				<th data-options="field:'cost',width:50,align:'left',editor:'text'">Cost</th>
				<th data-options="field:'total_amount',width:50,align:'left',editor:'text'">Total</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>
</div>	

</div>

<!-- LINEITEMS -->

 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/delivery/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/delivery/del_item';

    function url_detail(){
	 	var nomor=$('#shipment_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>index.php/delivery/items/'+nomor+'/json');
    }
	function print_delivery(){
		nomor=$("#shipment_id").val();
		url="<?=base_url()?>index.php/delivery/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function delete_delivery()
	{
		$.ajax({
				type: "GET",
				url: "<?=base_url()?>/index.php/delivery/delete/<?=$shipment_id?>",
				data: "",
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
						window.open('<?=base_url()?>index.php/delivery','_self');
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});							
					};
				},
				error: function(msg){alert(msg);}
		}); 				
	}    
	function save() {
        var url="<?=base_url()?>index.php/delivery/save";
        var param=$('#frmItem').serialize();
        void post_this(url,param,'message');
	}
 </script>
	
