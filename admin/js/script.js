// Pagination function
var displayTable = new DataTable('#display-table', {
    info: true,
    paging: true,
    responsive: true,
    fixedHeader: true,
    language: { 
        search: "", 
        searchPlaceholder: "Search..." ,
        lengthMenu: "Show _MENU_ Entries",
    },
    columnDefs: [
        {
            orderable: false,
            render: DataTable.render.select(),
            targets: 0
        },
        {
            target: 1,
            visible: false,
            searchable: false
        }
    ],
    order: [[1, 'asc']],
    select: {
        style: 'single',
        // selector: 'td:first-child'
    }
});

displayTable.on('select', function(e, dt, type, indexes) {
    if (type === 'row') {
        // Row selected
        var selectedRowData = displayTable.row(indexes).data();
        console.log("Selected row data:", selectedRowData); // Log the entire row data
        
        // Extract room ID from the selected row data
        var entryID = selectedRowData[1]; // Assuming room ID is in the second column (index 1)
        console.log("Selected ID:", entryID);
    }
});

// Action buttons
function toggleButtonState(buttonId) {
    var selectedRows = displayTable.rows({ selected: true }).count();
    var button = document.getElementById(buttonId);
    button.disabled = selectedRows === 0;
}

toggleButtonState('editEntryBtn');
toggleButtonState('deleteEntryBtn');

displayTable.on('select deselect', function () {
    toggleButtonState('editEntryBtn');
    toggleButtonState('deleteEntryBtn');
});

// Modal function
const addEntryButton = document.getElementById('addEntryBtn');
const addEntryModal = new bootstrap.Modal(document.getElementById('addEntryModal'));

const editEntryButton = document.getElementById('editEntryBtn');
const editEntryModal = new bootstrap.Modal(document.getElementById('editEntryModal'));

const deleteEntryButton = document.getElementById('deleteEntryBtn');

addEntryButton.addEventListener('click', function(event) {
    event.preventDefault();
    addEntryModal.show();
});
