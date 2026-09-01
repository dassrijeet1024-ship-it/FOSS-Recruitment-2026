function fetch_location(select_id="")
{
	var district_id=document.getElementById('district_id').value;
	//console.log(base_url + "settings/fetch_district_list/" + state_id);
	var url = base_url + "settings/fetch_location/" + district_id;
	if (select_id != "")
	{
		url += "/" + select_id;
	}
	//console.log(url);
	$.ajax({
		type: "POST",
		url: url,
		data : {
			district_id:district_id
		},
		dataType: "json",
		success: function(response){
			//console.log(response);
			
			$('#block_id').empty().append('<option value="" hidden>Select</option>');
            $('#municipality_id').empty().append('<option value="" hidden>Select</option>');
            $('#panchayat_id').empty().append('<option value="" hidden>Select</option>');
            $('#ps_id').empty().append('<option value="" hidden>Select</option>');
			
			$.each(response.municipality, function(index, item) {
				$('#municipality_id').append('<option value="' + item.municipality_id + '">' + item.municipality + '</option>');
			});
			$.each(response.block, function(index, item) {
				$('#block_id').append('<option value="' + item.block_id + '">' + item.block + '</option>');
			});
			$.each(response.ps, function(index, item) {
				$('#ps_id').append('<option value="' + item.ps_id + '">' + item.ps + '</option>');
			});
			
		},
		error: function(xhr,status,strErr){
			console.log(strErr);
		}	
	});
}
function fetch_district(select_id="")
{
	var state_id=document.getElementById('state_id').value;
	//console.log(base_url + "settings/fetch_district_list/" + state_id);
	var url = base_url + "settings/fetch_district_list/" + state_id;
	if (select_id != "")
	{
		url += "/" + select_id;
	}
	//console.log(url);
	$.ajax({
		type: "POST",
		url: url,
		data : {
			state_id:state_id
		},
		success: function(response){
			$('#district_id').html(response);
		},
		error: function(xhr,status,strErr){
			console.log(strErr);
		}
	});
}
function fetch_municipality(select_id="")
{
	var district_id=document.getElementById('district_id').value;
	//console.log(base_url + "settings/fetch_district_list/" + state_id);
	var url = base_url + "settings/fetch_municipality_list/" + district_id;
	if (select_id != "")
	{
		url += "/" + select_id;
	}
	//console.log(url);
	$.ajax({
		type: "POST",
		url: url,
		data : {
			district_id:district_id
		},
		success: function(response){
			$('#municipality_id').html(response);
			//console.log(response);
			
		},
		error: function(xhr,status,strErr){
			console.log(strErr);
		}	
	});
}
function fetch_block(select_id="")
{
	var district_id=document.getElementById('district_id').value;
	//console.log(base_url + "settings/fetch_district_list/" + state_id);
	var url = base_url + "settings/fetch_block_list/" + district_id;
	if (select_id != "")
	{
		url += "/" + select_id;
	}
	//console.log(url);
	$.ajax({
		type: "POST",
		url: url,
		data : {
			district_id:district_id
		},
		success: function(response){
			$('#block_id').html(response);
			//console.log(response);
		},
		error: function(xhr,status,strErr){
			console.log(strErr);
		}	
	});
}
function fetch_panchayat(select_id="")
{
	var block_id=document.getElementById('block_id').value;
	//console.log(base_url + "settings/fetch_district_list/" + state_id);
	var url = base_url + "settings/fetch_panchayat_list/" + block_id;
	if (select_id != "")
	{
		url += "/" + select_id;
	}
	//console.log(url);
	$.ajax({
		type: "POST",
		url: url,
		data : {
			block_id:block_id
		},
		success: function(response){
			$('#panchayat_id').html(response);
			//console.log(response);
		},
		error: function(xhr,status,strErr){
			console.log(strErr);
		}	
	});
}

function remove_entry(redir_cont)
{
	if(confirm("Do you really want to remove entry?")){
		window.location=base_url+"index.php/"+redir_cont;
	}
}
function insert_entry(redir_cont)
{
	if(confirm("Do you really want to apply for this course?")){
		window.location=base_url+"index.php/"+redir_cont;
	}
}
function update_entry(redir_cont){
	
	if(confirm("Do you really want to allow this user?")){
		window.location=base_url+"index.php/"+redir_cont;
	}
	
}

function getexpiry()
{
	var gid=document.getElementById('gid').value;
	var formData = {gid:gid};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/admin/user/get_expiry/"+gid,
		success: function(data){
			//alert(data);
			$("#subscription_expired").val(data);
		},
		error: function(xhr,status,strErr){
			alert(strErr);
		}	
	});
}