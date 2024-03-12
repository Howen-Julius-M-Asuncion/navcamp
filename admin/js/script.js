// Modal function
const addEntryButton = document.getElementById('addEntryBtn');
const addEntryModal = new bootstrap.Modal(document.getElementById('addEntryModal'));

const editEntryButton = document.getElementById('editEntryBtn');
const editEntryModal = new bootstrap.Modal(document.getElementById('editEntryModal'));

addEntryButton.addEventListener('click', function(event) {
    event.preventDefault();
    addEntryModal.show();
});

editEntryButton.addEventListener('click', function(event) {
    event.preventDefault();
    editEntryModal.show();
});

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
        }
    ],
    // fixedColumns: {
    //     start: 2
    // },
    order: [[1, 'asc']],
    select: {
        style: 'single',
        selector: 'td:first-child'
    }
});