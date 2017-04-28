<script type="text/javascript">
	$(function(){
		var $propsBody = $('.props');
		var i = 1;

		$('#addColumn').on('click',function(){
			$propsBody.append('<fieldset>'+
									'<label style="float: none;">#'+ ++i +'</label>'+
									'<input type="text" class="width_half nn" style="width:30%;" id="col_input_'+i+'" placeholder="Column name">'+
									'<input type="text" class="width_half dd" style="width:30%;" id="col_default_'+i+'" value="NULL" placeholder="Default value">'+
									'<select id="col_select_'+i+'" style="width:25%;" class="width_half">'+
										'<option>String</option>'+
										'<option>Integer</option>'+
										'<option>Text</option>'+
										'<option>Timestamp</option>'+
										'<option>List</option>'+
									'</select>'+
								'</fieldset>');
		});

		$('#save_col').on('click',function(){
			var name = $('#colName').val();
			
			if (!name)
				return;

			var collection = {
				name :  name,
				column:[]
			}

			$('.props').children().each(function(){
				var name = $(this).find('.nn').val();
				var deff = $(this).find('.dd').val();

				name && collection.column.push( [name, $(this).find('select').val(), deff]);
			});

			$.post('/admin/collection/create',collection,function(res){
				console.log(res);
			});
		})


	});
</script>

<?
$i = 1;
$col = $this->arData['data'];
?>

<article class="module width_full">
	<header><h3><?=isset($col['name']) ? $col['name'] : 'New' ?></h3></header>
		<div class="module_content">
				<fieldset>
					<label>Name</label>
					<input type="text" name="name" id="colName" value="<?=isset($col['name']) ? $col['name'] : '' ?>">
				</fieldset>
				<div class="props">

					<fieldset>
						<label style="float: none;">#1</label>
						<input type="text" class="width_half" style="width:30%;" value="Id" name="name" id="col_input_1" placeholder="Column name" disabled="true">
						<input type="text" class="width_half" style="width:30%;" name="name" disabled="true" value="Autoincrement" id="col_default_1" placeholder="Default value">
						<select id="col_select_1" class="width_half" style="width:28%;" disabled="true">
							<option>Integer</option>
						</select>
					</fieldset>

					<? if (isset($col['column'])) foreach ($col['column'] as $cname => $column):?>
						<? ++$i ?>
						<fieldset>
							<label style="float: none;">#<?=$i?></label>
							<input type="text" class="width_half nn" style="width:30%;" id="col_input_<?=$i?>" value="<?=$cname;?>" placeholder="Column name">
							<input type="text" class="width_half dd" style="width:30%;" id="col_default_<?=$i?>" value="<?=$column['default']?>" placeholder="Default value">
							<select id="col_select_<?=$i?>" style="width:25%;" class="width_half">
								<option <?=$column['type'] === 'String'? 'selected' : ''?> >String</option>
								<option <?=$column['type'] === 'Integer'? 'selected' : ''?>>Integer</option>
								<option <?=$column['type'] === 'Text'? 'selected' : ''?>>Text</option>
								<option <?=$column['type'] === 'Timestamp'? 'selected' : ''?>>Timestamp</option>
								<option <?=$column['type'] === 'List'? 'selected' : ''?>>List</option>
							</select>
						</fieldset>
					<? endforeach; ?>

				</div>
				<div class="clear"></div>
		</div>
	<footer>
		<div class="submit_link">
			<input type="submit" id="addColumn" value="+ Add column" class="alt_btn">
			<input type="submit" value="Save" id="save_col" class="alt_btn">
		</div>
	</footer>
</article><!-- end of post new article -->