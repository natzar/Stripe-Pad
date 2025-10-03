var table_tools = {
    visible: false,

    toggle_selected: function (table_id, checkbox) {
        var table = document.getElementById('main_table');
        var checkboxes = table.querySelectorAll('input[type="checkbox"]');
        var all_checked = true;
        var self = this;
        checkboxes.forEach(function (cb) {
            if (cb !== checkbox) {
                cb.checked = checkbox.checked;
            }
            if (!cb.checked) {
                all_checked = false;
                self.visible = false;
            } else {
                self.visible = true;
            }
        });

        // Update the "select all" checkbox state
        var select_all_checkbox = document.querySelector('#' + table_id + ' .select-all');
        if (select_all_checkbox) {
            select_all_checkbox.checked = all_checked;
        }
        if (self.visible) {
            document.getElementById('table_toolbox').style.display = 'flex';
        } else {
            document.getElementById('table_toolbox').style.display = 'none';
        }
    },

    action: function (type) { //type: 'archive', 'delete', 'mark_as_spam'
        var table = document.getElementById('main_table');
        var checkboxes = table.querySelectorAll('input[type="checkbox"]:checked');
        var selectedIds = this.getSelectedIds();
        if (checkboxes.length === 0) {
            alert("Please select at least one item to " + type + ".");
            return;
        }

        if (selectedIds.length === 0) {
            alert("No items selected.");
            return;
        }
        console.log("Selected IDs:", selectedIds);

        if (confirm("Are you sure you want to " + type + " the selected items?")) {

            // Perform the action here
            // For example, send an AJAX request to the server to perform the action on the selected items
            this.sendAction(type, selectedIds);
            // Reset checkboxes after deletion
            checkboxes.forEach(function (cb) {
                cb.checked = false;
            });

            selectedIds.forEach(function (id) {
                var row = document.getElementById('row_' + id);
                if (row) {
                    $(row).css('background-color', '#f8d7da').fadeOut(); // Optional: highlight the row
                    // Remove the row from the table
                }
            });
        }

    },


    getSelectedIds: function () {
        return $('#main_table input[type="checkbox"]:checked').map(function () {
            return this.value;
        }).get();
    },
    sendAction: function (action, ids) {
        console.log(`Sending action: ${action} for IDs:`, ids);
        if (!ids || ids.length === 0) return;

        $.ajax({
            url: base_url + '/app_service/emails/' + action,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ ids: ids }),
            success: function (response) {
                console.log(`✅ ${action} completed`, response);
                // Opcional: eliminar filas o actualizar UI
                // ids.forEach(id => {
                //     $('#row_' + id).fadeOut(); // Si cada fila tiene id="row_123"
                // });
            },
            error: function (xhr) {
                console.error(`❌ Error during ${action}:`, xhr.responseText);
                console.log(`There was an error while trying to ${action} items.`);
            }
        });
    }

}








if ($('#table_toolbox').length > 0) {

    if ($('#table_toolbox').css("display", "flex")) {
        $('#table_toolbox').css("display", "none");
    }

    $('#select_all').click(function () {
        var table_id = $(this).closest('table').attr('id');
        table_tools.toggle_selected(table_id, this);
    });
    $('#archive_button').click(function (e) {
        e.preventDefault();
        e.stopPropagation();


        var table_id = $(this).closest('table').attr('id');
        table_tools.action('archive');
    });
    $('#delete_button').click(function (e) {
        e.preventDefault();
        e.stopPropagation();


        table_tools.action('delete');
    });
    $('#mark_as_spam_button').click(function (e) {
        e.preventDefault();
        e.stopPropagation();


        table_tools.action('mark_as_spam');
    });

    $('#main_table input[type="checkbox"]').not('#select_all').on('change', function () {
        const anyChecked = $('#main_table input[type="checkbox"]').not('#select_all').is(':checked');
        $('#table_toolbox').css('display', anyChecked ? 'flex' : 'none');
    });

}