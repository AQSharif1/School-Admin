function addToList(element) {

  // Collect information from the book to be added
  let book = element.parentNode.parentNode;
  let gradeLevel, title, publisher, price;
  if (book.children[0].firstChild.nodeName != "DIV") {
    gradeLevel = book.children[0].innerHTML;
    title = book.children[2].innerHTML;
    publisher = book.children[4].innerHTML;
    price = book.children[7].innerHTML;
  } else {
    gradeLevel = book.children[0].firstChild.innerHTML;
    title = book.children[2].firstChild.innerHTML;
    publisher = book.children[4].firstChild.innerHTML;
    price = book.children[7].firstChild.innerHTML;
  }


  // Select relevant elements from the DOM
  let booklistForm = document.getElementById("booklist");
  let booklistEntries = document.getElementById("booklist_entries");
  let entry = document.createElement('div');
  let entryCount = document.getElementById("entry_count");
  let numberOfEntries = entryCount.getAttribute("value");

  // Create input elements and place them in the book list form
  // Each input corresponds to grade_level, title, publisher, price, or quantity
  let bookGradeLevel = document.createElement('input');
  bookGradeLevel.setAttribute("type", "text");
  bookGradeLevel.setAttribute("name", ("id_" + numberOfEntries))
  bookGradeLevel.setAttribute("value", gradeLevel);
  bookGradeLevel.setAttribute("readonly", "")
  entry.appendChild(bookGradeLevel);

  let bookTitle = document.createElement('input');
  bookTitle.setAttribute("type", "text");
  bookTitle.setAttribute("name", ("title_" + numberOfEntries))
  bookTitle.setAttribute("value", title);
  bookTitle.setAttribute("readonly", "")
  entry.appendChild(bookTitle);

  let bookPublisher = document.createElement('input');
  bookPublisher.setAttribute("type", "text");
  bookPublisher.setAttribute("name", ("publisher_" + numberOfEntries))
  bookPublisher.setAttribute("value", publisher);
  bookPublisher.setAttribute("readonly", "")
  entry.appendChild(bookPublisher);

  let bookPrice = document.createElement('input');
  bookPrice.setAttribute("type", "text");
  bookPrice.setAttribute("name", ("price_" + numberOfEntries))
  bookPrice.setAttribute("value", price);
  bookPrice.setAttribute("readonly", "")
  entry.appendChild(bookPrice);

  let bookQuantity = document.createElement('input');
  bookQuantity.setAttribute("type", "number")
  bookQuantity.setAttribute("name", ("quantity_" + numberOfEntries));
  bookQuantity.setAttribute("value", 1);
  entry.appendChild(bookQuantity);

  // Place the entry in the list and update the entry count for use in create_booklist.php
  booklistEntries.appendChild(entry);
  entryCount.setAttribute("value", (parseInt(entryCount.getAttribute("value")) + 1));
  booklistForm.hidden = false;

}
