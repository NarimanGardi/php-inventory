/*====================================
=            sidebar menu            =
====================================*/

$('.sidebar-menu').tree();

/*=====  End of sidebar menu  ======*/


/*=================================
=            datatable            =
=================================*/

$('.tables').dataTable();

/*=====  End of datatable  ======*/

/*=================================
=        input mask for forms            =
=================================*/
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', {
    'placeholder': 'dd/mm/yyyy'
})
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', {
    'placeholder': 'mm/dd/yyyy'
})
//Money Euro
$('[data-mask]').inputmask()

/*=====  End of input mask  ======*/

/*=================================
=        selec2 for chosseing options in forms            =
=================================*/
$('.select2').select2()

/*=====  End of input mask  ======*/

