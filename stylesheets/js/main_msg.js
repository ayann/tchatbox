jQuery(document).ready(function($) {
	$id_em=0;
	$id_rec=0;
	$('.row .thumbnail').hide();
	$('.btn-group .dropdown-menu li a').on('click', function(e) {
		e.preventDefault();
		$('#msg').empty();
		$id_rec=$(this).data('id');
		$id_em=$('#monId').text();
		get_image($id_em,$id_rec);
		recup_msg($id_em,$id_rec);
	});

	$('.col-md-4 a#send').on('click', function(e) {
		e.preventDefault();
		if ($id_rec && $id_em) {
			$msg=$('.col-md-8 textarea').val();
			$msg=$.trim($msg);
			if ($msg) {
				send_msg($id_em,$id_rec,$msg);
				$('.col-md-8 textarea').val('');
			}
		}
	});


	function send_msg (id_em,id_rec,msg) {
		$.ajax({
				url: 'req_ajax/send_msg.php',
				type: 'post',
				data: {
					id_em:id_em,
					id_rec:id_rec,
					msg:msg
				},
				success: function (data) {
					recup_msg(id_em,id_rec);
				}
			});
	}

	function recup_msg(id_em,id_rec) {
		if (id_em && id_rec) {
			$.ajax({
					url: 'req_ajax/recup_msg.php',
					type: 'post',
					data: {
						id_em:id_em,
						id_rec:id_rec
					},
					success: function (data) {
						$val=$('#msg').html();
						if ($val!==data) {
							$('#msg').empty();
							$('#msg').append(data);	
						}
						else{
							
						}
					}
				});
		}
	}

	function get_image (id_em,id_rec) {
		$.ajax({
				url: 'req_ajax/get_image.php',
				type: 'post',
				data: {
					id_em:id_em,
					id_rec:id_rec
				},
				success: function  (data) { 
					$('.row .thumbnail').next('br').remove();
					if (data) {
						nom=data;
						$('.row .thumbnail img').attr('src', 'photos/'+$id_rec+'/'+nom).parent().show();
					}else{
						nom='default.jpg';
						$('.row .thumbnail img').attr('src', 'photos/'+nom).parent().show();
					}
				}
			});
	}
	setInterval(function() {
	    recup_msg($id_em,$id_rec)
	}, 2000);
});