$(function () {
    
    $.ajax({
        url: 'api/books.php', //bez data bo chcemy all books

        type: 'GET',
        dataType: 'json'
    }).done(function (result) {
        // $('#bookList').html(result);

        for (var i = 0; i < result.length; i++) {

            var book = JSON.parse(result[i]);
            // console.log(book);

            var bookDiv = $('<div>').addClass('singleBook').
            html('<h3 data-id="' + book.id + '">' + book.title +
                '</h3><div class="description"><button class="deleteBook" data-id="' + book.id + '">delete</button></div>');
            $('#bookList').append(bookDiv);
        }
    });

$('#bookList').on('click', $('.deleteBook'), function (e) {
        console.log('click');
    });
});
