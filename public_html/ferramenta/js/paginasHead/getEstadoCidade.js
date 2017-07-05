

$(document).ready(function(){
        getEstados();
});

    function getEstados(){
      $.getJSON("administrativo/lista_cidade_estado/lista_estado.php", function(data){
        $.each(data, function(key, val){          
          var texto_inserir = "<option value="+val.id+">"+val.nome+"</option>";
          $('#estado').append(texto_inserir);
        });
      });
    }

    $(function(){
      $('#estado').change(function(){
        var id = $(this).val();
        
        $.ajax({
          type: "POST",
          url: "administrativo/lista_cidade_estado/lista_cidade.php?id="+id,
          dataType: "json",
          success: function(data){
            $('#cidade').children('.cidade').remove();
            $('#cidade').removeAttr('disabled').focus();
            $.each(data, function(key, val){
              var texto_cid_in = "<option value="+val.id+" class='cidade'>"+val.nome+"</option>";
              $('#cidade').append(texto_cid_in);
            });
            
          }
        });

      });
    });