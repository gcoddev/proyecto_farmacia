'use strict';

(function ($) {
  $(document).on('click', '.remove-row', function() {
      $(this).closest('tr').remove();
      updateRowNumbers();
  });

  function updateRowNumbers() {
    $('#invoice-table tbody tr').each(function(index) {
      $(this).find('td:first').text(String(index + 1).padStart(2, '0'));
    });
  }

  // Make table cells editable on click
  $('.editable').click(function() {
    const cell = $(this);
    const originalText = cell.text().substring(1); // Remove the leading ':'
    const input = $('<input type="text" class="invoive-form-control" placeholder="Valor" />').val(originalText);

    cell.empty().append(input);

    input.focus().select();

    input.blur(function() {
        const newText = input.val();
        cell.text(' ' + newText);
    });

    input.keypress(function(e) {
        if (e.which == 13) { // Enter key
            const newText = input.val();
            cell.text(':' + newText);
        }
    });
  });
})(jQuery);