$(document).ready(function() {
  $('#btnConfirm').click(function() {
    $('#spinner').show();
    $("#btnConfirm").prop("disabled", true);
    $("#btnCancel").prop("disabled", true);
    var TemplateID = $('#rdoConfirm').val();
    $.post('launchVM.php', {
        rdoVM: TemplateID,
      },

      function(response) {
        $('#spinner').hide();
        $('#divMain').replaceWith(response);
      });

  });

  $('#btnCancel').click(function() {
    window.location.href = '../single.php';
  });
});
