const consoleText = function (log = "Auncun log") {
    console.log(log);
    };
    
const handleBlock = function (log = "Auncun log") {
    alert('totoo');
    };

    module.exports = {
        consoleText: consoleText,
        handleBlock: handleBlock
    };

$(document).ready(function() {

//Gestion de submit
$('#formSearch').on('submit', function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
    $('div#ajaxResults').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
    $.ajax({
        type: 'POST',
        url:  $(this).attr('action'),
        data: data
    }).done( function(data) {
      //alert('retour Ajax :' + data.name +' price :'+data.price);
      $('div#ajaxResults').html(data);
    }).fail( function(data) {

    });

 });
    $('#tabProduct').DataTable({
        
    });


    $('#product').DataTable({
        columnDefs: [
            {
                targets: -1,
                className: 'dt-body-right'
            }
          ]
    });


    $('#btnTest').click(function(e){
        alert('Yes i can. Go ON');
        return false;
    });
});