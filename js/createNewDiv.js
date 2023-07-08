let counter = 2;
var reader = new FileReader();

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
  // newImage.src = 'img/working.png';
  newImage.src = reader.result;
  newImage.className = 'imgWork';
  newImage.alt = 'New Image';

  var newTitle = document.createElement('h3');
  var catalogTitle = document.getElementById('catalogTitle').value;
  newTitle.textContent = catalogTitle;

  var newDescription = document.createElement('p');
  var catalogDescription = document.getElementById('catalogDescription').value;
  newDescription.textContent = catalogDescription;

  // Append elements to the new item div
  newCatalogImgDiv.appendChild(newImage);
  newItem.appendChild(newCatalogImgDiv);
  catalogTextsDiv.appendChild(newTitle);
  catalogTextsDiv.appendChild(newDescription);
  newItem.appendChild(catalogTextsDiv);

  // Append the new item div to the container
  container.appendChild(newItem);

  counter++;
  $('#modalFreelanceAddCatalog').modal('hide');

  clearInputs();

}


function clearInputs(){
  var imageInput = document.getElementById('uploadInput');
  var imageCleared = document.getElementById('uploadedImage');
  var cataTitle = document.getElementById('catalogTitleLabel');
  var cataDesc = document.getElementById('catalogDescriptionLabel');
  cataTitle = null;
  cataDesc =null;
  imageInput.value = null;
  imageCleared.src = 'img/upload.png';
}



//for image upload
function catalogImgUp(event) {

  reader.onload = function () {
      var uploadedImage = document.getElementById('uploadedImage');
      uploadedImage.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}



var catalog = document.getElementById('addCatalog');
catalog.addEventListener('click', function () {
    $('#modalFreelanceAddCatalog').modal('show');
    $('#cancelSubmit').on("click", function (e) {
        $('#modalFreelanceAddCatalog').modal('hide');
    });


});


