$(function () {

  desabilitarBotoes();
  gerarLetra();

  // Ação do botão "Efetuar treinamento" 
  $(document).on('click', '#treinar', function(e){
    e.preventDefault();
    treinar();
  });

  function treinar() {
    var dados = $('#parametros').serialize();
    $.ajax({
      dataType: "json",
      type: 'POST',
      url: 'library/treinamento.php',
      async: true,
      data: dados,
      success: function(response) {
        modalAviso("<b>Terminou!</b>", "<h3>" + response + "</h3>");
      },
      beforeSend: function(){
        desabilitarBotoes();
        abreModalCarregando();
      },
      complete: function(){
        habilitarBotoes();
        fechaModalCarregando();
      }
    });
  };

  // Ação do botão "Gerar letra" 
  $(document).on('click', '#gerar-letra', function(e){
    e.preventDefault();
    gerarLetra();
  });

  function gerarLetra() {
    $.ajax({
      dataType: "json",
      url: 'library/gerarLetra.php',
      async: true,
      success: function(response) {
        montaTabuleiro(response);
      },
      beforeSend: function(){
        $("#letra").val("");
        $("#resultado").addClass("hide");
      }
    });
  };

 // Ação do select "Selecionar letra" 
  $("#letra").change(function() {
    $.ajax({
      dataType: "json",
      type: 'POST',
      url: 'library/selecionarLetra.php',
      async: true,
      data: {letra: $("#letra").val()},
      success: function(response) {
        montaTabuleiro(response);
      },
      beforeSend: function(){
        $("#resultado").addClass("hide");
      }
    });
  });

  function montaTabuleiro(vetor) {
    var count = 0;
    var html = "<table id='tabuleiro'>";
    var classe = ($("#gerar-letra").hasClass("disabled")) ? 'celula-disabled' : '';
    for (y = 0; y < 9; y++) {
      html += "<tr>";
      for (x = 0; x < 7; x++) {
        html += "<td class='"+classe+" celula'>"+vetor[count]+"</td>";
        count++;
      }
      html += "</tr>";
    }
    html += "</table>";
    $("#quadro").html(html);
  };

  // Ação de clicar no tabuleiro para coloca/remove rainha na célula clicada pelo usuário
  $(document).on('click', '.celula', function(e) {
    e.preventDefault();
    if (!$(".celula").hasClass("celula-disabled")) {
      trocarSimbolo($(this));
    }
  });

  function trocarSimbolo(elemento) {
    elemento.text($('input[name=simbolo]:checked').val());
  };

  // Ação do botão "Reconhecer letra" 
  $(document).on('click', '#reconhecer-letra', function(e){
    e.preventDefault();
    reconhecerLetra();
  });

  function reconhecerLetra() {
    $.ajax({
      dataType: "json",
      type: 'POST',
      url: 'library/reconhecimento.php',
      async: true,
      data: {letra: getLetra()},
      success: function(response) {
        letra = (response !== false) ? response : 'Desconhecida';
        $("#resultado").removeClass("hide");
        $("#letra-resultado").text(letra);
      },
      error: function() {
        $("#resultado").removeClass("hide");
        $("#letra-resultado").text('Desconhecida.');
      },
      beforeSend: function(){
        $("#letra-resultado").fadeOut("slow");
      },
      complete: function(){
        $("#letra-resultado").fadeIn("slow");
      }
    });
  };

  function getLetra() {
    var vetor = [];
    $(".celula").each( function(index, value) {
      vetor.push($(this).text());
    });
    return vetor;
  }

  function habilitarBotoes() {
    $("#gerar-letra").removeClass("disabled");
    $("#reconhecer-letra").removeClass("disabled");
    $("input[name=simbolo]").prop("disabled", false);
    $("#letra").prop("disabled", false);
    $(".celula").removeClass("celula-disabled");
  }

  function desabilitarBotoes() {
    $("#gerar-letra").addClass("disabled");
    $("#reconhecer-letra").addClass("disabled");
    $("input[name=simbolo]").prop("disabled", true);
    $("#letra").prop("disabled", true);
    $(".celula").addClass("celula-disabled");
    $("#resultado").addClass("hide");
  }

  function modalAviso(titulo, mensagem) {
    bootbox.dialog({
      title: "<h3 class='smaller lighter no-margin'>"+titulo+"</h3>",
      message: mensagem,
      buttons: {
        danger: {
          label: "<i class='ace-icon fa fa-times'></i> Fechar",
          className: "btn btn-sm btn-danger pull-right"
        }
      }
    });
  }

  function abreModalCarregando() {
    $('html, body').animate({ scrollTop: $("body").offset().top }, 'slow');
    var id = '.carregando';
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    $('#mask').fadeIn(1000);
    $('#mask').fadeTo("slow",0.8);
    var winH = $(window).height();
    var winW = $(window).width();
    $(id).css('top',  winH/2-$(id).height()/2);
    $(id).css('left', winW/2-$(id).width()/2);
    $(id).fadeIn(2000);
  };

  function fechaModalCarregando() {
    $('#mask').hide();
    $('.window').hide();
  };

  $("#quantidade_geracoes").ionRangeSlider({
    min: 0,
    max: 200,
    from: 100,
    type: 'single',
    step: 10,
    postfix: " gerações",
    prettify: false,
    hasGrid: true
  });

  $("#tamanho_vetor_intermediario").ionRangeSlider({
    min: 0,
    max: 20,
    from: 10,
    type: 'single',
    step: 1,
    postfix: " posições",
    prettify: false,
    hasGrid: true
  });

  $("#taxa_aprendizagem").ionRangeSlider({
    min: 0,
    max: 100,
    from: 20,
    type: 'single',
    step: 10,
    postfix: " %",
    prettify: false,
    hasGrid: true
  });
});