<style>
.table1 {
    background: url('<?=base_url('uploads/'.$result['template_image'])?>') no-repeat scroll center top;
	width:1324px;
	height:639px;
}
@page {
    size:A4 landscape;
    margin-left: 20px;
    margin-right: 20px;
    margin-top: 20px;
    margin-bottom: 20px;
    margin: 20;
    -webkit-print-color-adjust: exact;
}
</style>

<table class="table1" border="0">
	<tr>
        <td>&nbsp;</td>
		<td width="50%" height="468" align="right" valign="middle">
			<table width="100%" border="0">
				<tr>
					<td colspan="2"><img src="<?=base_url('assets/images/spacer.gif')?>" width="1" height="70" /></td>
				</tr>
				<tr>
					<td><img src="<?=base_url('assets/images/spacer.gif')?>" width="380" height="1" /></td>
					<td><img src="<?=$result['qrImage']?>" width="250" /></td>
				</tr>
			</table>
		</td>
    </tr>
	<tr>
        <td>&nbsp;</td>
        <td width="65%" align="right" valign="top">
            <table width="100%" border="0">
				<tr>
					<td><img src="<?=base_url('assets/images/spacer.gif')?>" height="10" /></td>
				</tr>
				<tr>
					<td><font size="+7"><b>UID : '.$sdata["survey_code"].'</b></font></td>
				</tr>
			</table>
        </td>
    </tr>
</table>