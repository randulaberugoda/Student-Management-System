$(document).ready(function () {
    // 1. Add student (POST)
    $("#addStudentButton").click(function () {
        alert("Add Student Clicked");
    });

    // 2. Search students
    $("#searchButton").click(function () {
        alert("Search Students");
    });

    // 3. Delete student
    $("#deleteButton").click(function () {
        alert("Delete Student");
    });

    // 4. navbar eka highlight
    $('.nav-link').on('click', function() {
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
    });


    // 5.find student val
    $('#searchKey').change(function() {
        var selectedText = $('#searchKey option:selected').text();
        $('#searchValueLabel').text('Enter ' + selectedText);
    });
});




