function getIndex(row)
{
	var idDocumento = $(row).closest('tr').children('td').eq(0).text();
	
	window.location.assign("imprimir?documentId="+idDocumento);
}