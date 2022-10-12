
function getIndex(row)
{
	var idLicencia = $(row).closest('tr').children('td').eq(0).text();
	window.location.assign("imprimir?lid="+idLicencia);
}

