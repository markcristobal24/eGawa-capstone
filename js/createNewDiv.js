let counter = 2;

function handleClick(element) {
  var itemId = element.id;
  alert("You clicked the div with ID: " + itemId);
  // You can perform any desired action here
  // based on the clicked div
}

function addContainer() {
  var container = document.getElementById('container');

  // Create a new item div
  var newItem = document.createElement('div');
  newItem.className = 'item';
  newItem.id = 'item-' + counter;
  newItem.onclick = function () {
    handleClick(this);
  };

  //this 2 divs will be appended inside the div created above
  var newCatalogImgDiv = document.createElement('div');
  newCatalogImgDiv.className = 'catalogImg';

  var catalogTextsDiv = document.createElement('div');
  catalogTextsDiv.className = 'catalogTexts';


  // Create elements for image, title, and description
  var newImage = document.createElement('img');
  newImage.src = 'img/working.png';
  newImage.className = 'imgWork';
  newImage.alt = 'New Image';

  var newTitle = document.createElement('h3');
  newTitle.textContent = 'Title ' + counter;

  var newDescription = document.createElement('p');
  newDescription.textContent = 'New Description ' + counter;

  // Append elements to the new item div
  newCatalogImgDiv.appendChild(newImage);
  newItem.appendChild(newCatalogImgDiv);
  catalogTextsDiv.appendChild(newTitle);
  catalogTextsDiv.appendChild(newDescription);
  newItem.appendChild(catalogTextsDiv);

  // Append the new item div to the container
  container.appendChild(newItem);

  counter++;
}