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
  var imageInput = document.getElementById('uploadInput');
  var catalogTitle = document.getElementById('catalogTitle').value;
  var catalogDescription = document.getElementById('catalogDescription').value;
  
  // Check if an image is uploaded
  if (imageInput.files.length === 0 || catalogTitle.trim() === '' || catalogDescription.trim() === '') {

    return;

  } else {

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

}



function clearInputs() {
  var imageInput = document.getElementById('uploadInput');
  var imageCleared = document.getElementById('uploadedImageCatalog');
  var catalogTitle = document.getElementById('catalogTitle');
  var catalogDescription = document.getElementById('catalogDescription');

  // Reset the image input
  imageInput.value = null;
  imageCleared.src = 'img/upload.png';

  // Reset the title and description inputs
  catalogTitle.value = '';
  catalogDescription.value = '';
}





//for image upload in catalog
function catalogImgUp(event) {

  reader.onload = function () {
      var uploadedImagecatalog = document.getElementById('uploadedImageCatalog');
      uploadedImagecatalog.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}

//for image upload in EDIT PROFILE
function editImgUp(event) {

  reader.onload = function () {
      var uploadedImageEdit = document.getElementById('uploadedImageEdit');
      uploadedImageEdit.src = reader.result;
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


var edit = document.getElementById('editFreelanceAcc');
edit.addEventListener('click', function () {
    $('#modalEditAccount').modal('show');
    $('#cancelEdit').on("click", function (e) {
        $('#modalEditAccount').modal('hide');
    });
});
