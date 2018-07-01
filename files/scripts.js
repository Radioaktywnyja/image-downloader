//aktywacja datepickera i blokada wpisywania z klawiatury
$(document).ready(function () {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }).keydown(false);
});

