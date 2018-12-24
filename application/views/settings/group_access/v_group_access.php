<div class="container-fluid">
	<div class="content">
        <h4>Setting Group Access</h4>
        <hr>
		<select class="form-control" style="width: 200px;" onchange="location = this.value">
			<?php foreach ($group as $key => $value): ?>
				<option value="<?= site_url('settings/group_access/index/'.$value['idgroup']) ?>" 
                    <?=($this->uri->segment(4) == $value['idgroup'] ) ? 'selected':''?>>
                    <?= $value['description'] ?></a>
                </option>
			<?php endforeach ?>
		</select>
		<table class="table table-striped" id="myTable">
			<thead>
				<tr>
					<th>Menu</th>
					<th width="15%" class="text-center">Access Create</th>
                    <th width="15%" class="text-center">Access Read</th>
                    <th width="15%" class="text-center">Access Update</th>
                    <th width="15%" class="text-center">Access Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($group_menu as $key => $value): ?>
				<tr>
					<td>
						<?php 
                            switch ($value['Level']) {
                                case '2':
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;';
                                    break;
                                case '3':
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;';
                                    break;
                                default:
                                break;
                            }
                        ?>
						<?= $value['Name'] ?>
					</td>
					<td class="text-center">
                        <input type="checkbox" name="CreateAccess" data-id="<?=$value['GroupsAccessId']?>" data-access-is="CreateAccess" <?=($value['CreateAccess'] == 1) ? 'checked' : '' ?>>
                    </td>
                    <td class="text-center">
                        <input type="checkbox" name="ReadAccess" data-id="<?=$value['GroupsAccessId']?>" data-access-is="ReadAccess" <?=($value['ReadAccess'] == 1) ? 'checked' : '' ?>>
                    </td>
                    <td class="text-center">
                        <input type="checkbox" name="UpdateAccess" data-id="<?=$value['GroupsAccessId']?>" data-access-is="UpdateAccess" <?=($value['UpdateAccess'] == 1) ? 'checked' : '' ?>>
                    </td>
                    <td class="text-center">
                        <input type="checkbox" name="DeleteAccess" data-id="<?=$value['GroupsAccessId']?>" data-access-is="DeleteAccess" <?=($value['DeleteAccess'] == 1) ? 'checked' : '' ?>>
                    </td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#myTable').on('click', 'input[type="checkbox"]', function() {
            var id  = $(this).data('id'),
                access_is = $(this).data('access-is');
                access = $(this).prop('checked') ? 1 : 0;
            $.ajax({
                type: 'post',
                url: '<?=site_url('settings/group_access/update_access')?>',
                data: {id:id, access_is:access_is, access:access},
                dataType: 'json',
                beforeSend: function() {},
                success: function() {},
                error: function() {}
            });
        });
	})
</script>