  $(document).ready(function(){
    
    // se no filto de banners a opcao todos tiver marcado o campo de palavra chave é desabilitado
    if ($('#campo_filtro option:selected').val()=='todos') {
      $('#string_filtro').prop('disabled','disabled');
    }

    // Habilita e desabilita o campo de palavra chave no evento "change"
    // Aplica a mask caso a opcao seja uma pesquisa por data
    $('#campo_filtro').change(function(){    
      var _this = $(this);
      var _selected = _this.children('option:selected');
      if (_selected.val()=='todos') {
        $('#string_filtro').prop('disabled','disabled');
      }else{
        $('#string_filtro').removeAttr('disabled');
      }
      if (_selected.val()=='data') {
        $('#string_filtro').mask('00/00/0000');
      }
    });

    // Busca o id do banner para fazer fazer a exclusao
    $('.excluir-imagem').click(function(){
        var _this = $(this);
        var id = _this.data('id');
        $('.modal-footer').find('#act-excluir-banner').val(id);
    });

    //Exclui um banner por completo e oculta o item excluido da lista de banners
    $('#act-excluir-banner').click(function(){   
        var _this = $(this);
        var id = _this.val();
        var url = "/banners/excluir";
        $.post( url, { 'id': id }, function( data ) {
            $('#confirm-excluir-banner').modal('hide');
            $('.item-list-'+id).hide();
        });
    });
  });