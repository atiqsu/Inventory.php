;(function(){
    // Fetch the database file.
    var db = new XMLHttpRequest();
    db.open(
      'GET',
      'db/db.txt',
      false
    );
    db.send(null);

    // Put items into an array.
    var items = [];
    items = db.responseText.split('\n');

    // Reverse the array to sort by date.
    items.reverse();

    // Remove the empty "items" created by a line with only a newline.
    items.splice(
      0,
      1
    );

    var item_count = items.length - 1;

    // No items? We're done here.
    if(item_count < 0){
        document.getElementById('inventory').innerHTML = '<tr><td>'
          + 'There are currently no items to display.';
        return;
    }

    var item = [];

    var while_count = item_count;
    do{
        // Load item into array.
        item = items[item_count - while_count].split('<');

        // Display item.
        document.getElementById('inventory').innerHTML += '<tr>'
          + '<td><b>' + item[1] + '</b>'
          + '<td>' + item[3].split('>>').join('<br>')
          + '<td>' + item[2]
          + '<td>' + item[0]
          + '</div>';
    }while(while_count--);
}());
