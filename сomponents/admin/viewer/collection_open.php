<?php
	$collections = $this->arData['data'][0];
	$columns = $this->arData['data'][1];
	$column_names = array_keys($columns);
	$collection_name = $this->arData['data'][2];
?>

<article class="module width_full">
	<header><h3 class="tabs_involved"><?=strtoupper($this->arData['bread_crumbs']['title']);?></h3>
		<ul class="tabs">
   			<li><a href="/admin/document/new/collection/<?=$collection_name;?>">Posts</a></li>
		</ul>
	</header>
	<div class="tab_container">
		<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
				<thead> 
					<tr> 
						<? foreach ($column_names as $cn):?>
		   					<th><?=strtoupper($cn);?></th> 
		    			<? endforeach; ?>

	    				<th>Actions</th> 
					</tr> 
				</thead> 
				<tbody> 
					<? foreach ($collections as $document):?>
						<tr> 
							<? foreach ($column_names as $cmane):?>
								<td><?=substr($document->$cmane,0,100);?></td> 
							<? endforeach; ?>

							<td>
		    					<a href="/admin/document/edit/<?=$document->Id?>/collection/<?=$collection_name;?>">
		    						<input type="image" src="<?=$this->path();?>/images/icn_edit.png" title="Edit">
		    					</a>
		    					<a href="/admin/document/remove/<?=$document->Id?>/collection/<?=$collection_name;?>">
		    						<input type="image" src="<?=$this->path();?>/images/icn_trash.png" title="Trash">
		    					</a>
		    				</td> 
						</tr>
					<? endforeach; ?>
				</tbody> 
			</table>
		</div>
	</div>
</article>