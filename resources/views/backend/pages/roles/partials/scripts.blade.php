<script type="text/javascript">

	$('#CheckPermissionAll').click(function () {
		if ($(this).is(':checked')) {
			//check all permission
			$('input[type=checkbox]').prop('checked', true);
		}else{
			//uncheck all permission
			$('input[type=checkbox]').prop('checked', false);
		}
	});

	function checkPermissionByGroup(className, checkThis){
        const groupIdName = $("#"+checkThis.id);
        const classCheckBox = $('.'+className+' input');
        if(groupIdName.is(':checked')){
             classCheckBox.prop('checked', true);
         }else{
             classCheckBox.prop('checked', false);
         }
         implementAllPermission();
     }

     function checkSinglePermission(groupClassName, groupID, countTotalpermission) {
     	const classCheckBox = $('.'+groupClassName+ ' input');
     	const groupIDCheckBox = $('#'+groupID);

     	if ($('.'+groupClassName+ ' input:checked').length == countTotalpermission) {
     		groupIDCheckBox.prop('checked', true);
     	}else{
     		groupIDCheckBox.prop('checked', false);
     	}

     	implementAllPermission();
     }

     function implementAllPermission() {
     	const countPermission = {{ count($all_permissions) }};
     	const countPermissionGroups = {{ count($permission_group) }};

     	if ($('input[type=checkbox]:checked').length >= (countPermission + countPermissionGroups)) {

     		$('#CheckPermissionAll').prop('checked', true);
     	}else{
     		$('#CheckPermissionAll').prop('checked', false);
     	}
     }

</script>