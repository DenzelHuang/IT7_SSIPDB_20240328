// Not working yet
$(document).ready(function() {
    // Function to validate datalist input 
    function validateDatalistInput(input) {
        const optionFound = Array.from(input.list.options).some((option) => option.value === input.value);
        if (optionFound) {
            $(input).removeClass('is-invalid');
        } else {
            $(input).addClass('is-invalid');
        }
    }

    // Function to perform custom validation on form submission
    function customValidation(event) {
        var form = event.currentTarget;
        var isValid = true;

        // Check datalist input
        var datalistInput = form.querySelector('input[list]');
        validateDatalistInput(datalistInput);
        if (!datalistInput.validity.valid) {
            isValid = false;
        }

        // Check if any input or select element is empty
        $(form).find('input, select').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // Check if at least one sector checkbox is checked
        var sectorCheckboxes = form.querySelectorAll('input[name="sectorCheckbox[]"]:checked');
        if (sectorCheckboxes.length === 0) {
            $(form).find('.invalid-feedback').show();
            isValid = false;
        } else {
            $(form).find('.invalid-feedback').hide();
        }

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    }

    // Add event listener to datalist input for real-time validation
    $('input[list]').on('change', function() {
        validateDatalistInput(this);
    });

    // Add event listener to forms with class .needs-validation
    $('.needs-validation').submit(function(event) {
        customValidation(event);
    });
});

// Function to get sectors (used in stock.create, stock.index, stock.edit)
function getSectors(locationId, sectorSelect) {
    // Fetch sectors based on the selected location
    $.ajax({
        url: '/getSectors',
        method: 'GET',
        data: {
            locationId: locationId
        },
        dataType: 'json',
        success: function(data) {
            // Populate sectors dropdown with fetched data
            $.each(data, function(index, sector) {
                sectorSelect.append($('<option>', {
                    value: sector.sector_id,
                    text: sector.sector_id
                }));
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching sectors:', error);
        }
    });
}