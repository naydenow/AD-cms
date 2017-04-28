<?
$collections = $this->arData['data'];
$i = 0;
?>

	<article class="module width_full">
		<header><h3 class="tabs_involved">Content Manager</h3>
			<ul class="tabs">
	   			<li><a href="/admin/collection/new">New</a></li>
			</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th>#</th> 
    				<th>Collection name</th> 
    				<th>Class name</th> 
    				<th>Docs</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<? foreach ($collections as $collection):?>

					<tr> 
	   					<td>#<?=++$i?></td> 
	    				<td><a href="/admin/collection/open/<?=$collection['name']?>"><?=$collection['name']?></a></td> 
	    				<td><?=$collection['class']?></td> 
	    				<td><?=$collection['docs']?></td> 
	    				<td>
	    					<a href="/admin/collection/edit/<?=$collection['name']?>">
	    						<input type="image" src="<?=$this->path();?>/images/icn_edit.png" title="Edit">
	    					</a>
	    					<a href="/admin/collection/remove/<?=$collection['name']?>">
	    						<input type="image" src="<?=$this->path();?>/images/icn_trash.png" title="Trash">
	    					</a>
	    				</td> 
					</tr>

				<? endforeach; ?> 

			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
	
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->